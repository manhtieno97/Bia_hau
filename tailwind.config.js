module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: [],
  theme: {
    extend: {
        borderRadius: {
            xl: '1rem',
            '2xl': '2rem',
            '3xl': '3rem'
        }
    },
  },
  variants: {
      margin: ['responsive', 'hover']
  },
  plugins: [],
}
