<template>
    <editor :api-key="apiKey"
            :cloud-channel="cloudChannel"
            :init="init"
            :value="value"
            @input="update"
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
            console.log(this.meta);
            if (typeof tinymceCloudConfig === 'undefined') {
                alert('The Tiny Cloud config file could not be found. Make sure you have at least one configuration saved.');
                return {};
            }
            if (typeof tinymceCloudConfig[this.meta.init] === 'undefined') {
                alert('Your requested Tiny Cloud config could not be found. Please confirm your Blueprint and Tiny Cloud configurations.')
                return {};
            }

            return tinymceCloudConfig[this.meta.init];
        }
    }
};
</script>
