<template lang="pug">
.container
    header.d-flex.flex-wrap.align-items-center.justify-content-center.justify-content-md-between.py-3.mb-4.border-bottom
        router-link.d-flex.align-items-center.col-md-3.mb-2.mb-md-0.text-dark.text-decoration-none(:to="{name: 'Home'}")
            img.bi.me-2(width='32' height='32' src="https://cdn.cssauthor.com/wp-content/uploads/2012/12/accelrys1.png?strip=all&lossy=1&resize=730%2C500&ssl=1")
        ul.nav.col-12.col-md-auto.mb-2.justify-content-center.mb-md-0
            li
                router-link.nav-link.px-2.link-secondary(:to="{name: 'Home'}") Главная
            li
                router-link.nav-link.px-2.link-secondary(:to="{name: 'Events'}") Мероприятия
            li
                router-link.nav-link.px-2.link-secondary(:to="{name: 'Contacts'}") Контакты
            li
                router-link.nav-link.px-2.link-secondary(:to="{name: 'About'}") О нас
                
        .col-md-3.text-end
            //- button.btn.btn-outline-primary.me-2.bvi-show(type='button') Войти
            //- button.btn.btn-primary(type='button') Зарегистрироваться
    main
        router-view

</template>
<script>
export default {
    created() {
        this.$store.dispatch('getCharacteristics')
    }
}
</script>
