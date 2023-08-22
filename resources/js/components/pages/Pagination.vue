<template>
   <div class="uk-position-right">
        <ul class="uk-pagination">
            <li><a>{{ pagination.current_page }}</a></li>
            <li class="uk-disabled"><span>...</span></li>
            <li><a>{{ pagination.per_page }}</a></li>
            <li><a>of {{ pagination.last_page }}</a></li>
            <li>
                <a @click="$emit('clickEmit', pagination.prev_page_url)" :disabled="pagination.prev_page_url == null ? dis==true : dis == false">
                <span uk-pagination-previous="" class="uk-icon uk-pagination-previous">
                    <svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg" data-svg="pagination-previous">
                        <polyline fill="none" stroke="#000" stroke-width="1.2" points="6 1 1 6 6 11"></polyline>
                    </svg>
                </span>
                </a>
            </li>
            <li>
                <a @click="$emit('clickEmit', pagination.next_page_url)"  :disabled="pagination.next_page_url == null ? dis==true : dis == false">
                <span uk-pagination-next="" class="uk-icon uk-pagination-next">
                    <svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg" data-svg="pagination-next">
                        <polyline fill="none" stroke="#000" stroke-width="1.2" points="1 1 6 6 1 11"></polyline>
                    </svg>
                </span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['pagination'],
    data() {
        return {
            dis: 1
        }   
    }
}
</script>

<style>

</style>