
<template>

    <div class="dropdown" id="dropdown" @click="toggle">
        <div class="dropdown-field-wrapper" :class="{'active' : show}">
            <div class="dropdown-field">
                <p>{{selected}}</p>
                <input type="text" hidden v-bind:value="selected" :name="fieldname">
            </div>
            <div class="dropdown-icon self-align-end">
                <i class="fa" v-bind:class="caret"></i>
            </div>
        </div>
        <transition :duration="200" name="list">
            <ul class="dropdown-list" v-if="show">
                <li class="dropdown-item" v-for="item in data" :value="item.value" @click="update">{{item.text}}</li>
            </ul>
        </transition>
    </div>
</template>

<script>

export default {
    props:['options', 'fieldname'],
    data(){
        return{
            selected : 'Select an element..',
            show: false,
            data: this.options,

        }
    },
    computed: {
        caret: function(){
            return this.show ? 'fa-caret-left' : 'fa-caret-down'
        }
    },
    methods:{
        toggle(){
            this.show = !this.show
        },
        update(e){
            var ele = e.target;

            if(ele.hasAttribute('value'))
            {
                this.selected = ele.getAttribute('value');
            }
            else
            {
                this.selected = ele.innerText;
            }
        },

    }
}
</script>

<style scoped>
    .dropdown{
        height: 2rem;
        border: 1px solid hsl(0, 0%, 90%);
        border-radius: 0.1rem;
        margin: 0px;

    }

    .dropdown-field-wrapper{
        display: flex;
        display: relative;
        height: 100%;
        -moz-appearance: textfield;
        -webkit-appearance: textfield;
        border: none;
        box-shadow: none;
        transition: box-shadow 200ms ease-in-out;
        -webkit-transition: box-shadow 200ms ease-in-out;
    }

    .dropdown-field-wrapper.active{
        box-shadow: 0px 0px 7px 7px rgba(0, 171, 255, 0.07);
    }

    .dropdown-field{
        flex: 1;
        overflow-x: hidden;
    }

    .dropdown-field>p{
        margin: 0em;
        padding-left: 1em;
        height: 100%;
        color: hsl(0, 0%, 40%);
    }

    .dropdown-icon{
        padding-right: 0.5rem;
        color: hsl(0, 0%, 80%);
    }

    .dropdown-list{
        list-style: none;
        display: absolute;
        top: 2px;
        right: 0px;
        left: 0px;
        padding: 0em;
        margin: 0em;
        background-color: hsl(0, 0%, 98%);
        border-radius: 0.1rem;
    }

    .list-enter{
        opacity: 0;
        visibility: hidden;
    }
    .list-enter-active{
        transition: all 200ms ease-in;
        -webkit-transition: all 200ms ease-in;
    }
    .list-enter-to{
        opacity: 1;
        visibility: visible;
    }

    .list-leave{
        opacity: 1;
        visibility: visible;
    }

    .list-leave-active{
        transition: opacity 200ms ease-out, visibility 200ms ease-out 200ms;
        -webkit-transition: opacity 200ms ease-out, visibility 200ms ease-out 200ms;
    }

    .list-leave-to{
        opacity: 0;
        visibility: hidden;
    }

    .dropdown-item{
        padding: 0.5em 0em 0.5em 1em;
        cursor: pointer;
        color: hsl(0, 0%, 40%);
        background-color: inherit;
    }

    .dropdown-item:first-child{
        margin-top: 1px;
    }
</style>
