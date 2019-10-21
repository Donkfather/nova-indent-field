<template>
    <div v-bind="wrapperAttributes">
        <component
            :is="'form-' + field.child.component"
            :errors="errors"
            :resource-id="resourceId"
            :resource-name="resourceName"
            :field="field.child"
            :ref="'field-' + field.child.attribute"
        />
    </div>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        computed: {
            wrapperAttributes() {
                return {
                    ...this.field.wrapperAttributes
                }
            }
        },
        methods: {
            fill(formData) {
                let field = this.field.child
                if (field.fill) {
                    field.fill(formData)
                }
            }
        },
    }
</script>
