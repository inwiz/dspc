
import { createRouter, createWebHistory } from 'vue-router'

import Front from '@/components/pages/Front.vue'
import PagePredictions from '@/components/pages/Predictions.vue'
import PageChat from '@/components/pages/Chat.vue'
import PageNotFound from '@/components/pages/NotFound.vue'
import Archive from '@/components/pages/Archive.vue'

const routes = [
    {path:'/',name:'Front',component: Front},
    {path:'/predictions',name:'PagePredictions',component: PagePredictions},
    {path:'/chat',name:'PageChat',component: PageChat},
    {path:'/archive',name:'Archive',component: Archive},
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: PageNotFound
      }

]



const router = createRouter({
history: createWebHistory(),
routes
})

export default router