<template>
    <div v-if="loading === false">
        <div class="mt-5 mb-5">
            <template v-if="courses.length">
                <table>
                    <tr>
                        <th class="index">#</th>
                        <th>Course</th>
                        <th>Author</th>
                        <th>Lessons</th>
                        <th>Actions</th>
                    </tr>
                    <template class="mt-3" v-for="(course, index) in courses">
                        <tr>
                            <td class="index">{{ index + 1 }}</td>
                            <td>{{ course.title }}</td>
                            <td>{{ course.author.name }}</td>
                            <td>{{ course.lessons.length }}</td>
                            <td>
                                <button type="submit" @click="deleteCourse(course.id)" class="btn btn-outline-danger">Delete</button>
                                <a :href="`courses/${course.id}/edit`" class="btn btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    </template>
                </table>
                <pagination class="customPagination" align="center" :data="courses" @pagination-change-page="list"></pagination>
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
            users: [],
            loading: true
        }
    },
    mounted() {
        this.list()
    },
    methods: {
        list(page = 1) {
            axios.get(`/api/v1/admin-panel?page=${page}`).then(response => {
                this.courses = response.data
                this.loading = false
                window.scrollTo(0,0);
            })
        },
        deleteCourse(id) {
            axios.delete('api/v1/courses/' + id).then(() => {
                this.list()
            })
        }
    }
}
</script>
