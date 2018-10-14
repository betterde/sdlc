import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

const router = new Router ({
	mode: 'hash',
	linkActiveClass: 'active',
	routes: [
		// {
		// 	path: '/login',
		// 	component: () => import('../views/Login.vue'),
		// 	beforeEnter: (to, from, next) => {
		// 		/**
		// 		 * 验证用户是否登录
		// 		 */
		// 		if (store.state.account.access_token) {
		// 			router.replace({
		// 				path: '/'
		// 			})
		// 		} else {
		// 			next();
		// 		}
		// 	}
		// },
		// {
		// 	path: '/',
		// 	beforeEnter: (to, from, next) => {
		// 		/**
		// 		 * 验证用户是否登录
		// 		 */
		// 		if (store.state.account.access_token) {
		// 			router.replace({
		// 				path: '/admin/dashboard'
		// 			})
		// 		} else {
		// 			router.replace({
		// 				path: '/login'
		// 			})
		// 		}
		// 	}
		// },
		{
			path: '*',
			component: () => import('../views/errors/NotFound.vue')
		}
	]
});

export default router;
