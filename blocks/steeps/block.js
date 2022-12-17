( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;

    const ALLOWED_BLOCKS = [ 'spyguy/steepsitem' ];
    const BLOCKS_THEMPLATE = [ ['spyguy/steepsitem',{}] ];

    const ITEM_THEMPLATE = [ ['core/image',{'lock' : {'move':'true','remove':'true'}}], ['core/heading',{'level': 4,'lock' : {'move':'true','remove':'true'}}], ['core/paragraph',{'lock' : {'move':'true','remove':'true'}}] ];

    blocks.registerBlockType( 'spyguy/steepsitem', {
        title: 'steepsitem',
        icon: 'editor-table',
        category: 'spyguy-blocks-secondary',
        description: 'steepsitem',
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
                template: ITEM_THEMPLATE,
                templatelock: 'insert'
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

    blocks.registerBlockType( 'spyguy/steeps', {
        title: 'Steeps',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'Steeps',
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
                allowedBlocks:ALLOWED_BLOCKS,
                template: BLOCKS_THEMPLATE,
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