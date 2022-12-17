( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;

    const ALLOWED_BLOCKS = [ 'spyguy/questionsitem' ];
    const BLOCKS_THEMPLATE = [ ['spyguy/questionsitem',{}] ];

    const ITEM_THEMPLATE = [ ['core/paragraph',{}] ];

    blocks.registerBlockType( 'spyguy/questionsitem', {
        title: 'questionsitem',
        icon: 'editor-table',
        category: 'spyguy-blocks-secondary',
        description: 'questionsitem',
        example: {
        },
        attributes: {
            title: {
                type:'string',
                default: ''
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
                label: 'Question',
                onChange: ( value ) => {
                    props.setAttributes( { title: value } );
                },
                value: props.attributes.title
            }
            ),

            el('label', {},'Answer'),

            el(InnerBlocks, {
                template: ITEM_THEMPLATE,
            }),

            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },
            el('h4',{},attributes.title),
            el('div',{className:'questions-bg'},
                el('div',{className:'questions-answer'},
                    el('h5',{},attributes.title),
                    el( InnerBlocks.Content )
                    )
                )
            )
        },
    } );

    blocks.registerBlockType( 'spyguy/questions', {
        title: 'Questions',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'questions',
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