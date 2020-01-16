<template>
    <div>
        <heading class="mb-6">Log</heading>

        <div class="card mb-6 py-3 px-6" v-if="log">
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Time</h4></div>
                <div class="w-3/4 py-4">
                    <p class="text-90">{{ log.created_at }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Status</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90">{{ log.status }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Method</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90">{{ log.method }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">URL</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90">{{ log.url }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">User</h4>
                </div>
                <div class="w-3/4 py-4" v-if="log.user">
                    <p class="text-90">{{ log.user.email }}, ID: {{ log.user.id }}</p>
                </div>
                <div class="w-3/4 py-4" v-else>
                    <p class="text-90">{{ log.user_id }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">IP</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90">{{ log.ip }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">User Agent</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90">{{ log.user_agent }}</p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Request Body</h4>
                </div>
                <div class="w-3/4 py-4">
                    <codemirror :value="log.request_body | beautiful" :options="cmOptions"></codemirror>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Request Query Parameters</h4>
                </div>
                <div class="w-3/4 py-4">
                    <codemirror :value="log.request_query_parameters | beautiful" :options="cmOptions"></codemirror>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Response Body</h4>
                </div>
                <div class="w-3/4 py-4">
                    <codemirror :value="log.response_body | beautiful" :options="cmOptions"></codemirror>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { codemirror } from 'vue-codemirror'
import 'codemirror/lib/codemirror.css'
import 'codemirror/theme/eclipse.css'
import 'codemirror/mode/javascript/javascript.js'

var beautify = require("json-beautify");

export default {
    data() {
        return {
            log: false,
            cmOptions: {
                tabSize: 4,
                matchBrackets: true,
                autoCloseBrackets: true,
                mode: "application/ld+json",
                lineWrapping: true,
                theme: 'eclipse',
                lineNumbers: true,
                line: true,
                readOnly: true,
                viewportMargin: Infinity
            }
        }
    },
    mounted() {
        Nova.request().get('/nova-vendor/nova-laravel-api-logger/logs/' + this.$route.params.id).then(response => {
            this.log = response.data;
        })
    },
    components: {
        codemirror
    },
    filters: {
        beautiful: function (value) {
            if(value.length == 0 || value == null){
                return '';
            }
            return  beautify(JSON.parse(value), null, 2, 100);
        }
    }
}
</script>

<style>
.CodeMirror{ height: auto; }
</style>
