<template>
    <div :class="{'loading': loading}">
        <div class="mt-4" v-for="course in courses">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <a :href="`/courses/${course.id}`" class="text-decoration-none text-dark head-link h3">{{ course.title }}</a>
                        <span class="h4 px-2">({{ course.author }})</span>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="px-3">
                            <span v-for="i in 5">
                                <span v-if="Math.round(course.rate) >= i"><i class="star fa fa-star"></i></span>
                                <span v-else><i class="star fa fa-star-o"></i></span>
                            </span>
                        </div>
                    </div>
                </div>
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
            axios.get('api/v1/subscriptions').then(response => {
                this.courses = response.data
                this.loading = false
            });
        }
    }
</script>
