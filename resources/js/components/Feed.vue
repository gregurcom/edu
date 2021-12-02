<template>
    <div :class="{'loading': loading}">
        <div class="mb-4 mt-2">
            <a href="/categories" class="btn btn-outline-dark">Categories</a>
        </div>
        <div class="row mb-4" v-for="course in courses">
            <div class="col-md-8">
                <div class="d-block mb-2">
                    <a :href="`/courses/${course.id}`" class="text-decoration-none text-dark h4">{{ course.title }}</a>
                    <div class="px-3 d-inline">
                        <span v-for="i in 5">
                            <span v-if="Math.round(course.rate) >= i"><i class="star fa fa-star"></i></span>
                            <span v-else><i class="star fa fa-star-o"></i></span>
                        </span>
                    </div>
                </div>
                <div class="mb-1">
                    {{ course.description }}
                </div>
                <a href="#" class="text-decoration-none text-muted">{{ course.author }}</a> ·
                <span class="text-muted">{{ course.created_at }}</span>
            </div>
            <div class="col-md-4 d-flex">
                <img :src="'/images/404.png'" width="250" height="180">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                courses: [],
                loading: true,
            }
        },
        mounted() {
            axios.get('api/v1/courses').then(response => {
                this.courses = response.data.data
                this.loading = false
            })
        },
    }
</script>
