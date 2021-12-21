<template>
    <div v-if="loading === false">
        <a href="/courses/create" class="btn btn-outline-dark">Create course</a>
        <a href="/tasks" class="btn btn-outline-dark">Tasks</a>
        <div class="mt-5 mb-5">
            <h2>Your courses:</h2>
            <div class="mt-3" v-for="course in courses">
                <h4><a :href="`courses/${course.id}`" class="text-decoration-none text-dark">{{ course.title }}</a></h4>
                <p>{{ course.description }}</p>
                <button type="submit" @click="deleteCourse(course.id)" class="btn btn-outline-danger">Delete</button>
                <a :href="`courses/${course.id}/edit`" class="btn btn-outline-primary">Edit</a>
            </div>
        </div>
    </div>
    <div v-else class="atom">
        <atom-spinner
            :animation-duration="1000"
            :size="80"
            :color="'#69d2f1'"
        />
    </div>
</template>

<script>
    import {AtomSpinner} from 'epic-spinners'
    export default {
        components: {
            AtomSpinner
        },
        data() {
            return {
                courses: [],
                loading: true
            }
        },
        mounted() {
            axios.get('api/v1/dashboard').then(response => {
                this.courses = response.data
                this.loading = false
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
