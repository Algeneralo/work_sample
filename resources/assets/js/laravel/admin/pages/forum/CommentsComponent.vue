<template>
    <div>
        <comment v-for="(comment,$index) in comments" :key="$index" :comment="comment" :index="$index"></comment>
        <div class="row mx-0 px-20 py-30" v-show="comments.length===0">
            {{trans("general.no-data-found")}}
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler" force-use-infinite-wrapper=".comments">
            <div slot="spinner">Loading2...</div>
            <div slot="no-more">No more message</div>
            <div slot="no-results">No more message</div>
        </infinite-loading>
    </div>
</template>

<script>
    import Comment from './CommentComponent'
    import InfiniteLoading from 'vue-infinite-loading';
    require('livewire-vue')

    export default {
        name: "comments",
        props: {
            topicId: {}
        },
        components: {Comment, InfiniteLoading},
        data() {
            return {
                page: 1,
                comments: []
            };
        }, methods: {
            infiniteHandler($state) {
                axios.get("/admin/forum/" + forumId + "/themen/" + topicId + "/comments", {
                    params: {
                        page: this.page,
                    },
                }).then(({data}) => {
                    console.log({data})
                    for (let counter = 0; counter < data.data.length; counter++) {
                        this.comments.push(data.data[counter])
                    }
                    if (data.hasNext) {
                        this.page += 1;
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                }).catch((e) => {
                    $state.complete();
                });
            },
        }
    }
</script>
