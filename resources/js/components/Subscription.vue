<template>
    <div v-if="loading === false">
        <template v-if="courses.data.length">
            <div class="row mb-4" v-for="course in courses.data">
                <div class="col col-md-8 mb-4">
                    <div class="d-block mb-2">
                        <a :href="`/courses/${course.id}`" class="text-decoration-none text-dark h4">{{ course.title }}</a>
                        <div class="stars">
                            <span v-for="i in 5">
                                <span v-if="Math.round(course.rate) >= i"><i class="star fa fa-star"></i></span>
                                <span v-else><i class="star fa fa-star-o"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="mb-1 description">
                        {{ course.description }}
                    </div>
                    <img :src="`/images/${course.author.avatar}`" width="25" height="20">
                    <a href="#" class="text-decoration-none text-muted">{{ course.author.name }}</a> ·
                    <span class="text-muted">{{ course.created_at }}</span>
                </div>
                <div class="col col-md-4 d-flex justify-content-center">
                    <img :src="`/images/${course.image}`" class="feed-image" width="250" height="150" :alt="`${course.title}`">
                </div>
            </div>
            <pagination class="customPagination" align="center" :data="courses" @pagination-change-page="list"></pagination>
        </template>
        <template v-else>
            <div v-if="loading === false" class="text-center alert alert-info text-center">
                You have not subscriptions yet
            </div>
        </template>
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
    import pagination from 'laravel-vue-pagination'
    import {AtomSpinner} from 'epic-spinners'
    export default {
        components: {
            pagination,
            AtomSpinner
        },
        data() {
            return {
                courses: [],
                loading: true,
            }
        },
        mounted(){
            this.list()
        },
        methods: {
            list(page = 1) {
                axios.get(`/api/v1/subscriptions?page=${page}`).then(response => {
                    this.courses = response.data
                    this.loading = false
                    window.scrollTo(0, 0);
                })
            }
        }
    }
</script>
