<template>
    <div class="container wrapper flex-grow-1 mt-3">
        <div>
            <a href="/courses/create" class="btn btn-outline-dark">Create course</a>
            <a href="/tasks" class="btn btn-outline-dark">Tasks</a>
        </div>
        <div class="mt-5 mb-5">
            <h2 class="mb-5">Your courses:</h2>
            <div class="mt-3" v-for="course in courses">
                <h4><a :href="`courses/${course.id}`" class="text-decoration-none text-dark">{{ course.title }}</a></h4>
                <p>{{ course.description }}</p>
                <button type="submit" @click="deleteCourse(course.id)" class="btn btn-outline-danger">Delete</button>
                <a :href="`courses/${course.id}/edit`" class="btn btn-outline-primary">Edit</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                courses: [],
            }
        },
        mounted() {
            axios.get('api/v1/dashboard').then(response => {
                this.courses = response.data
            })
        },
        methods: {
            fetchCourses() {
                axios.get('api/v1/dashboard').then(response => {
                    this.courses = response.data;
                });
            },
            deleteCourse(id) {
                axios.delete('api/v1/courses/' + id).then(response => {
                    this.fetchCourses()
                })
            }
        }
    }
</script>
