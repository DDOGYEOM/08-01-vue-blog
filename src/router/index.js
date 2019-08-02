import Vue from 'vue';
import MainComponent from '@/components/MainComponent';
import TodoComponent from '@/components/TodoComponent';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes:[
        {
            path:'/',
            name:'Main',
            component:MainComponent
        },
        {
            path:'/todo',
            name:'Todo',
            component:TodoComponent
        }
    ]
})