<template>
    <div v-if="loading === false">
        <a href="/settings" class="btn btn-outline-dark">Settings</a>
        <a href="/courses/create" class="btn btn-outline-dark">Create course</a>
        <a href="/tasks" class="btn btn-outline-dark">Tasks</a>
        <router-link v-if="user.can.accessAdminPanel">
            <a href="/admin-panel" class="btn btn-outline-dark">Admin Panel</a>
        </router-link>
        <div class="mt-5 mb-5">
            <h2>Your courses:</h2>
            <template v-if="courses.length">
                <div class="mt-3" v-for="course in courses">
                    <h4><a :href="`courses/${course.id}`" class="text-decoration-none text-dark">{{ course.title }}</a></h4>
                    <p>{{ course.description }}</p>
                    <button type="submit" @click="deleteCourse(course.id)" class="btn btn-outline-danger">Delete</button>
                    <a :href="`courses/${course.id}/edit`" class="btn btn-outline-primary">Edit</a>
                </div>
            </template>
            <template v-else>
                <div class="alert alert-info text-center">No courses yet</div>
            </template>
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
                user: [],
                loading: true
            }
        },
        mounted() {
            axios.get('api/v1/dashboard').then(response => {
                this.courses = response.data.courses
                this.user = response.data.user
                this.loading = false
            })
        },
        methods: {
            fetchCourses() {
                axios.get('api/v1/dashboard').then(response => {
                    this.courses = response.data.courses;
                });
            },
            deleteCourse(id) {
                axios.delete('api/v1/courses/' + id).then(() => {
                    this.fetchCourses()
                })
            }
        }
    }
</script>
