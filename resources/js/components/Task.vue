<template>
    <div class="container wrapper flex-grow-1 mt-5 mb-4">
        <div class="mb-5" v-for="task in tasks">
            <h3 class="d-inline"><a href="#" class="head-link text-decoration-none text-black">{{ task.title }}</a></h3>
            <span class="text-secondary px-2">{{ task.end_time }}</span>
            <p class="mt-2">{{ task.description }}</p>

            <button type="submit" class="btn btn-outline-danger" @click="deleteTask(task.id)">Delete</button>
            <a :href="`/tasks/${task.id}/edit`" class="btn btn-outline-info">Edit</a>
        </div>

        <form @submit.prevent="submit" class="mt-5">
            <input type="text" name="title" class="form-control" placeholder="Task" v-model="fields.title">
            <div class="input-group mt-1">
                <input type="datetime-local" name="end_time" class="form-control" v-model="fields.end_time">
                <button class="btn btn-outline-info" type="button">End time (optional)</button>
            </div>
            <textarea name="description" class="form-control mt-1" placeholder="Description" v-model="fields.description"></textarea>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-dark">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                fields: {},
            }
        },
        mounted() {
            axios.get('api/v1/tasks').then(response => {
                this.tasks = response.data
            })
        },
        methods: {
            fetchTasks() {
                axios.get('api/v1/tasks').then(response => {
                    this.tasks = response.data;
                });
            },
            submit() {
                axios.post('api/v1/tasks', this.fields).then(response => {
                    this.fields = {}
                    this.fetchTasks()
                }).catch (error => {
                    console.log(error)
                })
            },
            deleteTask(id) {
                axios.delete('api/v1/tasks/' + id).then(response => {
                    this.fetchTasks()
                })
            },
        }
    }
</script>
