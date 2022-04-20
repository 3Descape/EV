<template>
    <div>
    <vue-agile class="main mb-3" ref="main" :options="mainOptions" :as-nav-for="asNavFor1">
        <div class="slide slide--main" :class="`slide--${index}`" v-for="(image, index) in imagesProp" :key="image.id">
            <img :src="`/storage/${image.path}`">
        </div>
    </vue-agile>
    <vue-agile class="thumbnails" ref="thumbnails" :options="thumbnailOptions" :as-nav-for="asNavFor2">
        <div class="slide slide--thumbnail" :class="`slide--${index}`" v-for="(image, index) in imagesProp" :key="image.id" @click="$refs.thumbnails.goTo(index)">
            <img :src="`/storage/${image.path}`">
        </div>

        <template v-slot:prevButton>
            <i class="fa fa-chevron-left"></i>
        </template>

        <template v-slot:nextButton>
            <i class="fa fa-chevron-right"></i>
        </template>
    </vue-agile>
    </div>
</template>

<script>
import { VueAgile } from 'vue-agile'

export default {
    props: {
        imagesProp: {
            required: true,
        }
    },
    components: {
      VueAgile,
    },
    data() {
        return {
            asNavFor1: [],
            asNavFor2: [],
            mainOptions: {
                dots: false,
                fade: true,
                navButtons: false
            },
            thumbnailOptions: {
                autoplay: false,
                centerMode: true,
                dots: false,
                navButtons: false,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 5
                        }
                    },

                    {
                        breakpoint: 1000,
                        settings: {
                            navButtons: true
                        }
                    }
                ]
            }
        }
    },
    mounted() {
        this.asNavFor1.push(this.$refs.thumbnails)
        this.asNavFor2.push(this.$refs.main)
    }
}
</script>

<style lang="scss">
.thumbnails
{
    // margin: 0 -5px;
    width: calc(100% + 10px);
}

.agile
{
    &__nav-button
    {
        background: transparent;
        border: none;
        color: #ccc;
        cursor: pointer;
        font-size: 24px;
        transition-duration: .3s;

        &:hover
        {
            color: #888;
        }

        .thumbnails &
        {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);

            &--prev
            {
                left: -45px;
            }

            &--next
            {
                right: -45px;
            }
        }
    }
    &__dot
    {
        margin: 0 10px;

        button
        {
            background-color: #eee;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: block;
            height: 10px;
            font-size: 0;
            line-height: 0;
            margin: 0;
            padding: 0;
            transition-duration: .3s;
            width: 10px;
        }

        &--current, &:hover
        {
            button
            {
                background-color: #888;
            }
        }
    }
}
.slide
{
    align-items: center;
    box-sizing: border-box;
    color: #fff;
    display: flex;
    height: 40vmax;
    // width: 100%;
    justify-content: center;

    &--thumbnail
    {
        cursor: pointer;
        height: 100px;
        padding: 0 5px;
        transition: opacity .3s;

        &:hover
        {
            opacity: .75;
        }

        img
        {
            height: 100%;
            object-fit: cover;
            object-position: center;
            width: 100%;
        }
    }


    &--main
    {
        img
        {
            // height: 100%;
            object-fit: cover;
            object-position: center;
            width: 100%;
        }
    }
}
</style>