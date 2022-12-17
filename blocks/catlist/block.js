( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;
    const category_array = object.category_array;
    var catList = category_array.map(function(item) {
        return el('a',{className: item.class, href:'/'+item.slug},
            el('img',{
                src:item.img
            }),
            el('p',{}, item.name)
            )
    });

    blocks.registerBlockType( 'spyguy/catlist', {
        title: 'Category list',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'Category list',
        example: {
        },
        attributes: {
            title: {
                type:'string',
                default: ''
            },
            subtitle: {
                type:'string',
                default: ''
            }
        },
        edit: function(props) {
            var attributes = props.attributes;

            return [

            el( 'div', { 
                className: props.className,
            },
            el( 'div', {className: 'cat-list',},catList,),

            el('label',{},'Bottom content:'),
            
            el(InnerBlocks, {
            }),

            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },
            el('div', {className:'container'},

                el( 'div', {className: 'cat-list'},),

                el( InnerBlocks.Content )

                )
            )
        },
    } );
}(
    window.wp.blocks,
    window.wp.components,
    window.wp.element,
    window.wp.editor,
    ) );