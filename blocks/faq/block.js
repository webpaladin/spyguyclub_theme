( function( blocks, components, i18n, element, editor, compose ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;
    const ALLOWED_BLOCKS = [ 'spyguy/faqitem' ];
    const FAQ_TEMPLATE = [[ 'spyguy/faqitem',{} ]];
    const MY_TEMPLATE = [
    ['spyguy/emptyblock', {className:'title',templatelock:'all'},[
    ['core/heading',{"level":4}]
    ]],
    ['spyguy/emptyblock', {className:'text',templatelock:false},[
    ['core/paragraph',{}]
    ]]

    ];

    blocks.registerBlockType( 'spyguy/faqitem', {
        title: 'faqitem',
        icon: 'button',
        description: 'faqitem',
        example: {
        },
        attributes: {

        },
        edit: function(props) {
            var attributes = props.attributes;
            return [

            el( 'div', { 
                className: props.className,
            },
            
            el(InnerBlocks, {
                template: MY_TEMPLATE,
                templateLock: 'all',
            }),

            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },
            
            el( InnerBlocks.Content )
            )

            
        },
    } );

    blocks.registerBlockType( 'spyguy/faq', {
        title: 'FAQ',
        icon: 'button',
        category: 'spyguy-blocks',
        description: 'faq',
        example: {
        },
        attributes: {
            templatelock: {
                type:'string',
                default: false
            },
            rbtitle: {
                type: 'string',
                default: '',
            },
        },
        edit: function(props) {
            var attributes = props.attributes;
            return [

            el( 'div', { 
                className: props.className,
            },

            el( TextControl,
            {
                label: 'Title',
                onChange: ( value ) => {
                    props.setAttributes( { rbtitle: value } );
                },
                value: props.attributes.rbtitle
            }
            ),
            
            el(InnerBlocks, {
                allowedBlocks:ALLOWED_BLOCKS,
                template: FAQ_TEMPLATE,
                templateLock: false,
            }),

            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },

            (props.attributes.rbtitle) ? (
                el('h2',{},props.attributes.rbtitle)
                ) : (''),
            
            el( InnerBlocks.Content )
            )

            
        },
    } );


}(
    window.wp.blocks,
    window.wp.components,
    window.wp.i18n,
    window.wp.element,
    window.wp.editor,
    window.wp.compose
    ) );