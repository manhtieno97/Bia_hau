<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('category', 'categories');
        CRUD::operation('list', function() {
            CRUD::removeButton('show');
        });
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Tên danh mục'
        ]);
        $this->crud->addColumn([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Đường dẫn danh mục'
        ]);
        $this->crud->addColumn([
            'name' => 'parent',
            'label' => 'Danh mục cha'
        ]);

        CRUD::addColumn([   // select_multiple: n-n relationship (with pivot table)
            'label'     => 'Bài viết', // Table column heading
            'type'      => 'relationship_count',
            'name'      => 'articles', // the method that defines the relationship in your Model
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('article?category_id='.$entry->getKey());
                },
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CategoryRequest::class);

        //CRUD::setFromDb(); // fields
        CRUD::addField([
            'name' => 'name',
            'label' => 'Tên danh mục',
        ]);
        CRUD::addField([
            'name' => 'slug',
            'label' => 'Đường dẫn danh mục (URL)',
            'type' => 'text',
            'hint' => 'Sẽ tự động được tạo từ tên của bạn, nếu để trống.',
            // 'disabled' => 'disabled'
        ]);
        CRUD::addField([
            'label' => 'Danh mục cha',
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
        ]);
        CRUD::addField([
            'name' => 'color',
            'label' => 'Màu sắc',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'content',
            'label' => 'Nội dung danh mục',
            'type' => 'ckeditor',
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 10);
    }
}
