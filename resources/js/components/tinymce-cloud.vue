<template>
    <editor :value="value" @input="update"
            :api-key="apiKey"
            :init="init"
            :cloud-channel="cloudChannel"
    ></editor>
</template>

<script>
import editor from '@tinymce/tinymce-vue';

export default {
    mixins: [Fieldtype],
    components: {
        editor: editor
    },
    computed: {
        apiKey() {
            return this.meta.key;
        },
        cloudChannel() {
            if (this.meta.cloud_channel) {
                return this.meta.cloud_channel;
            }
            return 6;
        },
        init() {
            return this.meta.init;
        }
    }
};
</script>
