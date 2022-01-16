<template>
    <div v-if="loading === false">
        <div class="mt-5 mb-5">
            <form @submit.prevent="submit" id="search-form">
                <div class="row g-1 justify-content-end">
                    <div class="col-auto">
                        <div id="search">
                            <i class="fa fa-search"></i>
                        </div>
                        <input id="search-input" type="search" name="q" class="form-control" v-model="query" placeholder="Search...">
                    </div>
                </div>
            </form>
            <template v-if="courses.data.length">
                <table>
                    <thead>
                        <tr>
                            <th class="index">#</th>
                            <th>Course</th>
                            <th>Author</th>
                            <th class="lessons">Lessons</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(course, index) in courses.data">
                            <tr>
                                <td class="index">{{ index + 1 }}</td>
                                <td>{{ course.title }}</td>
                                <td>{{ course.author.name }}</td>
                                <td class="lessons">{{ course.lessons.length }}</td>
                                <td>
                                    <button type="submit" @click="deleteCourse(course.id)" class="btn btn-outline-danger">Delete</button>
                                    <a :href="`courses/${course.id}/edit`" class="btn btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <pagination class="customPagination mt-4" id="panel-pagination" align="center" :data="courses" @pagination-change-page="list"></pagination>
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
import pagination from 'laravel-vue-pagination'
import {AtomSpinner} from "epic-spinners";
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
    mounted() {
        this.list()
    },
    methods: {
        list(page = 1) {
            if (this.query == null || this.query == '') {
                axios.get(`/api/v1/admin-panel?page=${page}`).then(response => {
                    this.courses = response.data
                    this.loading = false
                    window.scrollTo(0,0);
                })
            } else {
                axios.get('api/v1/admin-panel/search?q=' + this.query + '&page=' + page).then(response => {
                    this.courses = response.data
                    this.loading = false
                    window.scrollTo(0,0);
                })
            }
        },
        deleteCourse(id) {
            axios.delete('api/v1/courses/' + id).then(() => {
                this.list(this.courses.meta.current_page)
            })
        },
        submit() {
            if (this.query !== '') {
                axios.get('api/v1/admin-panel/search?q=' + this.query).then(response => {
                    this.courses = response.data
                }).catch (error => {
                    console.log(error)
                })
            }
        },
    }
}
</script>
