<template lang="pug">
.card.mb-3(v-for="post in posts")
    .row.g-0
        .col-md-4
            img.img-fluid.rounded-start(:src='post.image ? post.image : defaultImage')
        .col-md-8
            .card-body
                h5.card-title {{ post.title }}
                p.card-text.SelectedFilterElements
                    span.badge {{ $parent.getEducational_institutionName(post.educational_institution) }}
                    span.badge {{ $parent.getEducation_levelName(post.education_level) }}
                    span.badge {{ $parent.getCityName(post.city) }}
                p.card-text {{ post.description }}
                p.card-text.cardBottom
                    router-link.btn.btn-primary(:to="{ name: 'SinglePost', params: { id: post.id }}") Подробнее
                    i.fa.fa-phone(v-if="post.phone") {{ post.phone }}
</template>
<script>
export default {
    data() {
        return {
            defaultImage: 'https://i.ytimg.com/vi/87ILM9KFZHM/maxresdefault_live.jpg'
        }
    },
    props: {
        posts: Array
    },
    methods: {

    }
}
</script>