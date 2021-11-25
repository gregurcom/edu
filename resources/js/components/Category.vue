<template>
    <div class="container wrapper flex-grow-1 mt-5 mb-3">
        <form action="" method="GET">
            <div class="row g-1 justify-content-end">
                <div class="col-auto">
                    <input type="search" name="q" class="form-control border-dark search-input" placeholder="Course search...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-dark">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <h2 class="mt-5">
            <a href="" class="text-dark text-decoration-none head-link"></a>
        </h2>
        <div class="mt-4">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <ul>
                            <li>
                                <a href="" class="text-decoration-none text-dark h3"></a>
                                <span class="h4 px-2">(<a href="#" class="text-decoration-none text-dark"></a>)</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="px-3">
                            <span>
                                <i class="star fa fa-star-o"></i>
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
                categories: [],
            }
        },
    }
</script>
