<template>
    <div v-if="loading === false">
        <form @submit.prevent="submit">
            <div class="row g-1 justify-content-end">
                <div class="col-auto">
                    <div id="search">
                        <i class="fa fa-search"></i>
                    </div>
                    <input id="search-input" type="search" name="q" class="form-control border-dark search-input" v-model="query" placeholder="Search...">
                </div>
            </div>
        </form>

        <div class="mb-4 mt-4">
            <a href="/categories" class="btn btn-outline-dark">Categories</a>
        </div>
        <div class="row mb-4" v-for="course in courses.data">
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
                <img :src="'/images/404.png'" width="250" height="150">
            </div>
        </div>
        <pagination align="center" :data="courses" @pagination-change-page="list"></pagination>
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
                query: null,
                loading: true
            }
        },
        mounted(){
            this.list()
        },
        methods: {
            list(page = 1) {
                axios.get(`/api/v1/courses?page=${page}`).then(response => {
                    this.courses = response.data
                    this.loading = false
                    window.scrollTo(0,0);
                })
            },
            submit() {
                axios.get('api/v1/search?q=' + this.query).then(response => {
                    this.courses = response.data
                    this.query = []
                }).catch (error => {
                    console.log(error)
                })
            },
        }
    }
</script>
