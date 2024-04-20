import { createRouter, createWebHistory } from 'vue-router'
import Year from '../components/Year.vue'
import ProductCategory from '@/components/ProductCategory.vue'
import IncomeSource from '@/components/IncomeSource.vue'
import ExpensSource from '@/components/ExpensSource.vue'


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Year',
            component: Year
        },
        {
            path: '/productcategory',
            name: 'Product Category',
            component: ProductCategory
        },
        {
            path: '/incomesource',
            name: 'Income Source',
            component: IncomeSource
        },
        {
            path: '/expenssource',
            name: 'Expense Source',
            component: ExpensSource
        },

    ]
})

export default router