<template>
    <div>
        <heading class="mb-6">API Logs</heading>

        <div class="card relative" v-if="data">

            <div class="overflow-hidden overflow-x-auto relative">

                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Method</th>
                            <th>URL</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <router-link v-for="log in data.data" :key="log.id" :to="{name: 'nova-laravel-api-logger-log', params: {id : log.id}}" tag="tr" class="cursor-pointer">
                            <td>{{ log.created_at }}</td>
                            <td>{{ log.status }}</td>
                            <td>{{ log.method }}</td>
                            <td>{{ log.url }}</td>
                            <td>{{ log.ip }}</td>
                        </router-link>
                    </tbody>
                </table>

            </div>
            <div class="bg-20 rounded-b">
                <nav class="flex justify-between items-center">
                    <button @click="prev()" :disabled="showPrev" class="btn btn-link py-3 px-4 text-primary dim">
                        Previous
                    </button>
                    <span class="text-sm text-80">
                        Page {{ data.current_page }} of {{ data.last_page }}
                    </span>
                    <button @click="next()" :disabled="showNext" class="btn btn-link py-3 px-4 text-primary dim">
                        Next
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: false,
        }
    },
    mounted() {
        this.getLogs(1);
    },
    methods: {
        getLogs(page) {
            Nova.request().get('/nova-vendor/nova-laravel-api-logger/logs?page=' + page).then(response => {
                this.data = response.data;
            })
        },
        next() {
            this.getLogs(this.data.current_page + 1);
        },
        prev() {
            this.getLogs(this.data.current_page - 1);
        }
    },
    computed: {
        showNext() {
            return this.data.current_page == this.data.last_page;
        },
        showPrev() {
            return this.data.current_page == 1;
        }
    }
}
</script>
