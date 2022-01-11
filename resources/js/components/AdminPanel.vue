<template>
    <div v-if="loading === false">
        <div class="mt-5 mb-5">
            <template v-if="courses.data.length">
                <table>
                    <tr>
                        <th class="index">#</th>
                        <th>Course</th>
                        <th>Author</th>
                        <th class="lessons">Lessons</th>
                        <th>Actions</th>
                    </tr>
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
                </table>
                <pagination class="customPagination mt-4" style="margin-bottom: -25px" align="center" :data="courses" @pagination-change-page="list"></pagination>
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
            loading: true
        }
    },
    mounted() {
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
        deleteCourse(id) {
            axios.delete('api/v1/courses/' + id).then(() => {
                this.list()
            })
        }
    }
}
</script>
