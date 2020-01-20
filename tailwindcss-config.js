module.exports = {
    theme: {
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1480px',
        },
        fontSize: {
            'xs': '.75rem',
            'sm': '.875rem',
            'tiny': '.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
            'custom-xl': '1.3125rem'
        },
        fontFamily: {
            'inherit':'inherit'
},
        borderWidth: {
            default: '1px',
            '0': '0',
            '2': '2px',
            '4': '4px',
            '6': '6px',
            '10':'10px'
        },
        colors: {
            body: '#F6F6F6',
            black: {
                default: '#000000',
                lighter: '#4B4B4B',
                lighter_title: '#403E3D',
            },
            white: {
                default: '#ffffff',
                'op-8': 'rgba(252,249,249,0.8)',
            },
            blue: {
                default: '#0079C2',
            },
            green:'#1A7300',
            red:'#D50000',
            gray: {
                default: 'gray',
                lighter: '#8E999F',
                // 1: '#828282',
            },
            border:'#E5E5E5',
        },
        extend: {
            spacing: {
                '96': '24rem',
                '128': '32rem',
            }
        },
        boxShadow: {
            default: '0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)',
            md: ' 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06)',
            lg: ' 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05)',
            xl: ' 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04)',
            '2xl': '0 25px 50px -12px rgba(0, 0, 0, .25)',
            '3xl': '0 35px 60px -15px rgba(0, 0, 0, .3)',
            inner: 'inset 0 2px 4px 0 rgba(0,0,0,0.06)',
            outline: '0 0 0 3px rgba(66,153,225,0.5)',
            focus: '0 0 0 3px rgba(66,153,225,0.5)',
            custom:'0 1px 3px 1px #00000026',
            'none': 'none',
        },
        // inset: {
        //     '0': 0,
        //     auto: 'auto',
        //     'negative-15': '-15px',
        //     '15': '15px',
        // },
        // variants: {
        //     fontSize: ['responsive', 'hover', 'focus','focus-within'],
        // },
    },
    variants: {
        borderColor: ['hover', 'focus', 'focus-within'],
        borderWidth: ['responsive', 'last', 'hover', 'focus'],
        display: ['responsive', 'hover', 'focus'],
        pointerEvents: ['responsive', 'focus'],
    },
};
