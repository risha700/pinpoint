
export default {

    state:{
        cart:[],
        products:[],
        cartProductList:[],
        perPage:0,
        totalProducts:0,
        categories:[],
        authUser:[]

    },
    mutations:{
        setCart (state, cart) {
            state.cart = cart
        },
        login (state, user) {
            state.authUser = user
        },
        updateQty(state,item){
            state.cart.cartCount = JSON.parse(state.cart.cartCount)+ JSON.parse(item[1]) - JSON.parse(item[0].qty)
            state.cart.cartTax = state.cart.cartTax - (item[0].tax * item[0].qty) + (item[0].tax * item[1])
            state.cart.cartSubtotal = state.cart.cartSubtotal - item[0].price * item[0].qty + item[0].price * item[1]
            state.cart.cartTotal = state.cart.cartSubtotal + state.cart.cartTax
            state.cart.cartContent.find((itm)=>item[0].rowId === itm.rowId? itm.qty = item[1]:'')

        },
        removeItem(state,item){
             state.cart.cartContent.splice(state.cart.cartContent.indexOf(item), 1)
             state.cart.cartCount = state.cart.cartCount-item.qty
             state.cart.cartSubtotal = state.cart.cartSubtotal - (item.qty*item.price)
             state.cart.cartTax = state.cart.cartTax - (item.qty*item.tax)
             state.cart.cartTotal = state.cart.cartTax + state.cart.cartSubtotal


        },
        addToWishList(state,item){
             state.cart.cartContent.splice(state.cart.cartContent.indexOf(item), 1)
             state.cart.cartCount = state.cart.cartCount-item.qty
             state.cart.cartSubtotal = state.cart.cartSubtotal - (item.qty*item.price)
             state.cart.cartTax = state.cart.cartTax - (item.qty*item.tax)
             state.cart.cartTotal = state.cart.cartTax + state.cart.cartSubtotal
             state.cart.wishList = state.cart.wishList.concat(item)
             // state.cart.wishList = Object.assign({[item.rowId]:item}, state.cart.wishList )


        },
        createWishList(state,item){
             state.cart.wishList = state.cart.wishList.concat(item)
        },
        moveToCart(state, item){
            state.cart.wishList.splice(state.cart.wishList.indexOf(item), 1)
            state.cart.cartCount = Number(state.cart.cartCount) + item.qty
            state.cart.cartSubtotal = Number(state.cart.cartSubtotal) + (item.qty*item.price)
            state.cart.cartTax = Number(state.cart.cartTax) + (item.qty*item.tax)
            state.cart.cartTotal = state.cart.cartTax + state.cart.cartSubtotal
            state.cart.cartContent = state.cart.cartContent.concat(item)

        },
        removeWishList(state, item){
            state.cart.wishList.splice(state.cart.wishList.indexOf(item), 1)
        },
        incrementCartCount({cart},i){
            cart.cartCount+=i
        },
        loadProducts(state,data){
            if (data.data.length) {
                state.perPage = data.per_page
                state.totalProducts = data.total
                state.products = state.products.concat(data.data);
                window.events.$emit('stateLoaded')
                if (state.products.length < data.total) {
                    window.events.$emit('FirstLoadTrigger')
                }
                if (state.products.length === data.total) {
                    window.events.$emit('stateComplete')
                }

            }
        },
        loadAllProducts(state,products){
            state.cartProductList = products
        },
        loadAllCategories(state,categories){
            state.categories = categories
        }

    },
    getters:{
        productStock: (state) => (data) => {
         let product = state.cartProductList.find((i)=> i.id == data.id)
            if(Object(product).hasOwnProperty('stock')){
                return  product.stock
            }
        },
        productOptions: (state) => (data) => {
         let product = state.cartProductList.find((p)=> p.id == data.id)

            if(Object(product).hasOwnProperty('options')){
                return _.chain(Object.values(product.options)).groupBy('name').mapValues(function (v) {
                    return _.chain(v).mapValues('type').value()
                }).value();

            }
        },
        productSlug: (state) => (data) => {
            let product = state.cartProductList.find((i)=> i.slug == data)
            return product;
        },
         categoryProducts: (state) => (data) => {
            if(Object(data).hasOwnProperty('categories')){
                data  = data.categories[0].name
            }
            let cat = state.categories.find((c)=> c.name == data)

            if(Object(cat).hasOwnProperty('products')){
                return cat.products
            }


        },
    },
    actions:{
        async fetchCart ({ commit }) {
            await axios.get('/api/cart')
                .then((cart) =>{commit('setCart', cart.data)})
                .catch((error)=>{console.log(error);flash(error.response.data,'error')})
        },
        async updateQty({ commit },item){
            await axios.patch('/api/cart/'+ item[0].rowId, {
                quantity:item[1],
                id:item[0].id
            })
                .then((response)=>{
                    commit('updateQty',item)
                    flash(response.data)

                }).catch((error)=> {
                console.log(error)
                flash(error.response.data, 'error')
            })

        },
        removeItem({commit},item ){
            axios.delete('/api/cart/'+ item[0].rowId);
            commit('removeItem', item[0])

        },
        async addToWishList ({ commit }, item) {
            await axios.post(`/api/cart/${item.rowId}/wishlist`)
                .then(response=>{
                    commit('addToWishList', item)
                    flash(response.data)

                })
                .catch((error)=>{
                    flash(error.response.data, 'warning')
                    console.log(error)
                })
        },
        async createWishList ({ commit }, item) {
            await axios.post(`/wishlist`, item)
                .then(response=>{
                    commit('createWishList', item)
                    flash(response.data)
                })
                .catch((error)=>{
                    flash(error.response.data, 'warning')
                    console.log(error)
                })
        },
        async moveToCart({commit},item){

            await axios.post(`/wishlist/${item.rowId}` )
                .then((response) =>{
                    flash(response.data);
                    commit('moveToCart', item)
                }).catch(error=>{
                    console.log(error);
                    flash(error.response.data, 'warning')
                    commit('removeWishList', item)
                });
        },
        async removeWishList({commit},item ){
            await axios.delete(`/wishlist/${item.rowId}`)
            commit('removeWishList', item)


        },
         incrementCartCount({commit}, e){
             commit('incrementCartCount',e)
        },

        async addToCart({dispatch},form){
           await form.post('/api/cart' )
                .then((response) =>{
                    flash(response);
                    dispatch('incrementCartCount',1)
                }).catch(error=>{

                   flash(error,'warning');

                });
        },
        // async addToCart({dispatch},data){
        //     return new Promise((resolve, reject) => {
        //           axios.post('/cart',  data  )
        //             .then((response) =>{
        //                 flash(response.data);
        //                 dispatch('incrementCartCount',1)
        //                 resolve(response.data)
        //
        //             }).catch(error=>{
        //                 flash(error.response.data,'warning');
        //               reject(error.response.data)
        //
        //             });
        //
        //     })
        //
        // },

        async loadProducts(state) {
            if(state.state.products.length!=0){
                if(state.state.products.length === state.state.totalProducts) return window.events.$emit('stateComplete');
            }
               await axios.get('/api/shop', {
                   params: {
                       page: state.state.products.length / state.state.perPage + 1,
                   },
                }).then(( {data} ) => {
                   state.commit('loadProducts',data)
                });

        },

        async loadAllProducts(state){
            if(state.state.cartProductList.length==0)
            await axios.get('/api/shop').then(({data})=>state.commit('loadAllProducts', data))
        },
        async loadAllCategories(state){
            // if(state.state.categories.length==0)
                await axios.get('/api/shop').then(({data})=>state.commit('loadAllCategories', data))
        },

       async  login(state,form){
             // await axios.post('/login',data)
           await form.post('/login')
                .then(({data})=>state.commit('login', data))
                .catch((error)=>{
                console.log(error.response.data);

            });
        }


    }
}