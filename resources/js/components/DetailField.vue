<template>
    <div v-bind="wrapperAttributes">
        <component
            :is="'detail-' + field.child.component"
            :resource-id="resourceId"
            :resource-name="resourceName"
            :field="field.child"
            :ref="'field-' + field.child.attribute"
        />
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    computed: {
        wrapperAttributes() {
            return {
                ...this.field.wrapperAttributes
            }
        }
    }
}
</script>
