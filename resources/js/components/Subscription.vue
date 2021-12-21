<template>
    <div v-if="loading === false">
        <template v-if="courses.length">
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
        </template>
        <template v-else>
            <div v-if="loading === false" class="text-center alert alert-info">
                You have not subscriptions yet
            </div>
        </template>
    </div>
    <div v-else class="atom">
        <atom-spinner
            :animation-duration="1000"
            :size="60"
            :color="'#ff1d5e'"
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
