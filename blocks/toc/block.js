( function( blocks,components, element, editor ) {
    var el = element.createElement;
    const { TextControl } = components;

    blocks.registerBlockType( 'spyguy/toc', {
        title: 'Table of Content',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        example: {},
        attributes: {
            title: {
                type: 'string',
                default: 'Content'
            },  
        },
        edit: function(props) {
            return el(
                'div',{className: props.className,},
                el( TextControl,
                {
                    label: 'Title Table of Content',
                    onChange: ( value ) => {
                        props.setAttributes( { title: value } );
                    },
                    value: props.attributes.title
                }
                ),
                );
        },
        save: function(props) {
            return el('div', {
                className: props.className,
            },
                (props.attributes.title) ? (el('div',{className:'toc-title-block'},el('h6', {className: 'toc-title',}, props.attributes.title))):(''),
            el('nav',{},
                el('ul', {
                    className: 'toc-list'
                }, ),
                ),
            );
        },
    } );
}(
    window.wp.blocks,
    window.wp.components,
    window.wp.element,
    window.wp.editor,
    ) );