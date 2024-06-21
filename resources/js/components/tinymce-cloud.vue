<template>

    <div>
        <div v-if="meta.init_mode === 'defer' && !enabled">

        </div>

        <editor v-if="enabled"
                :api-key="apiKey"
                :cloud-channel="cloudChannel"
                :init="init"
                :value="value"
                @input="update"
        ></editor>
        <div v-else
             class="bg-gray-100 border border-gray-200 rounded overflow-hidden"
             :class="{
                 'mt-4' : value?.trim() != ''
             }">
            <div class="font-medium text-xs px-4 py-1.5 bg-gray-300 flex items-center justify-between">
                <div>
                    {{ __('statamic-tinymce-cloud::fieldtype.preview', {display: config.display }) }}
                </div>
                <div class="whitespace-nowrap">
                    <button class="btn-primary btn-xs" @click.prevent="enabled = true">
                        {{ __('statamic-tinymce-cloud::fieldtype.enable') }}
                    </button>
                </div>
            </div>
            <div v-if="value"
                 :class="[contentCss]">
                <div class="max-w-full prose prose-sm text-xs px-4 py-3 border-t border-gray-200"
                     v-html="value"></div>
            </div>
        </div>
    </div>

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
        contentCss() {
            return 'tinymce_cloud_' + Statamic.$slug.create(this.meta.init.toLowerCase());
        },
        init() {
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
    },
    data() {
        return {
            enabled: false
        };
    },
    mounted() {
        if (this.meta.init_mode !== 'defer') {
            this.enabled = true;
        }
    }
};
</script>
