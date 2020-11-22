<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Article;
use App\Models\Product;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'Sản phẩm');
        $this->crud->operation('list', function () {
            $this->crud->addColumn([
                'name' => 'title',
                'label' => 'Tiêu đề',
            ]);
            $this->crud->addColumn([
                'name' => 'image',
                'label' => 'Ảnh',
                'type' => 'image',
                // 'prefix' => 'folder/subfolder/',
                // image from a different disk (like s3 bucket)
                // 'disk'   => 'disk-name',
                // optional width/height if 25px is not ok with you
                'height' => '40px',
                'width'  => '40px',
            ]);
            $this->crud->addColumn([
                'name' => 'date',
                'label' => 'Ngày viết',
                'type' => 'date',
            ]);
            $this->crud->addColumn([
                'name'    => 'status',
                'label'   => 'Trạng thái',
                'type'    => 'radio',
                'options' =>  Product::getStatuses(), // optional
                'wrapper' => [
                    'element' => 'span',
                    'class' => function ($crud, $column, $entry, $related_key) {
                        if ($column['text'] == Product::getStatuses()[Product::STATUS_HIDDEN]) {
                            return 'badge badge-danger';
                        }elseif ($column['text'] == Product::getStatuses()[Product::STATUS_SHOW]){
                            return 'badge badge-success';
                        }else{
                            return 'badge badge-default';
                        }

                    },
                ],
            ]);
            $this->crud->addColumn([
                'name' => 'featured',
                'label' => 'Nổi bật',
                'type' => 'check',
            ]);
            $this->crud->addColumn([
                'label' => 'Danh mục',
                'type' => 'select',
                'name' => 'category_id',
                'entity' => 'category',
                'attribute' => 'name',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category/'.$related_key.'/show');
                    },
                ],
            ]);
            $this->crud->addColumn('tags');

            $this->crud->addFilter([ // select2 filter
                'name' => 'category_id',
                'type' => 'select2',
                'label'=> 'Danh mục',
            ], function () {
                return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
            }, function ($value) { // if the filter is active
                $this->crud->addClause('where', 'category_id', $value);
            });

            $this->crud->addFilter([ // select2_multiple filter
                'name' => 'tags',
                'type' => 'select2_multiple',
                'label'=> 'Thẻ',
            ], function () {
                return \Backpack\NewsCRUD\app\Models\Tag::all()->keyBy('id')->pluck('name', 'id')->toArray();
            }, function ($values) { // if the filter is active
                $this->crud->query = $this->crud->query->whereHas('tags', function ($q) use ($values) {
                    foreach (json_decode($values) as $key => $value) {
                        if ($key == 0) {
                            $q->where('tags.id', $value);
                        } else {
                            $q->orWhere('tags.id', $value);
                        }
                    }
                });
            });
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(\App\Http\Requests\ProductRequest::class);

            $this->crud->addField([
                'name' => 'title',
                'label' => 'Tiêu đề',
                'type' => 'text',
                'placeholder' => 'Tiêu đề của bạn',
            ]);
            $this->crud->addField([
                'name' => 'slug',
                'label' => 'Đường dẫn (URL)',
                'type' => 'text',
                'hint' => 'Sẽ tự động được tạo từ tên của bạn, nếu để trống.',
                // 'disabled' => 'disabled'
            ]);
            $this->crud->addField([
                'name' => 'date',
                'label' => 'Ngày viết',
                'type' => 'date',
                'default' => date('Y-m-d'),
            ]);
            $this->crud->addField([
                'name' => 'content',
                'label' => 'Nội dung',
                'type' => 'ckeditor',
                'placeholder' => 'Nội dung bài viết',
            ]);
            $this->crud->addField([
                'name' => 'image',
                'label' => 'Hình ảnh',
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
                // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
                // 'prefix'    => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            ]);
            $this->crud->addField([
                'label' => 'Danh mục',
                'type' => 'relationship',
                'name' => 'category_id',
                'entity' => 'category',
                'attribute' => 'name',
                'inline_create' => true,
                'ajax' => true,
            ]);
            $this->crud->addField([
                'label' => 'Thẻ',
                'type' => 'relationship',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'tag'],
                'ajax' => true,
            ]);
            $this->crud->addField([
                'name' => 'status',
                'label' => 'Trạng thái',
                'type'        => 'radio',
                'options'     => [
                    // the key will be stored in the db, the value will be shown as label;
                    0 => "Hiển thị",
                    1 => "Ẩn"
                ],
                'value' => 0,
                // optional
                'inline'      => true, // show the radios all on the same line?
            ]);
            $this->crud->addField([
                'name' => 'featured',
                'label' => 'Nổi bật',
                'type' => 'checkbox',
            ]);
        });
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Category model.
     * @return JSON
     */
    public function fetchCategory()
    {
        return $this->fetch(\App\Models\Category::class);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Tag model.
     * @return JSON
     */
    public function fetchTags()
    {
        return $this->fetch(\App\Models\Tag::class);
    }
}
