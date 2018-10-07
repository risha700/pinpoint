export default {

    state:{
        cart:[],
        products:[],
        cartProductList:[],
        perPage:0,
        totalProducts:0,

    },
    mutations:{
        setCart (state, cart) {
            state.cart = cart
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
         let product = state.products.find((p)=> p.id == data.id)
            if(Object(product).hasOwnProperty('options')){
                // return product.options.map((o) => o.name)
                return Object.values(product.options).map((o) => o.name)
            }
            // this.$forceUpdate();
        }
    },
    actions:{
        async fetchCart ({ commit }) {
            await axios.get('/cart')
                .then((cart) =>{commit('setCart', cart.data)})
                .catch((error)=>console.log(error))
        },
        async updateQty({ commit },item){
            await axios.patch('/cart/'+ item[0].rowId, {
                quantity:item[1],
                id:item[0].id
            })
                .then(function (response) {
                    commit('updateQty',item)
                    flash(response.data)

                }).catch((error)=> {
                console.log(error)
                flash(error.response.data, 'error')
            })

        },
        removeItem({commit},item ){
            axios.delete('cart/'+ item[0].rowId);
            commit('removeItem', item[0])

        },
        async addToWishList ({ commit }, item) {
            await axios.post(`/cart/${item.rowId}/wishlist`)
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

        async addToCart({dispatch},data){

           await axios.post('/cart',  data  )
                .then((response) =>{
                    flash(response.data);
                    // window.events.$emit('itemAddedToCart', response);
                        dispatch('incrementCartCount',1)
                }).catch(error=>{
                    flash(error.response.data,'warning');

                });
        },

        async loadProducts(state) {
            if(state.state.products.length!=0){
                if(state.state.products.length === state.state.totalProducts) return window.events.$emit('stateComplete');
            }
               await axios.get('/api/product', {
                   params: {
                       page: state.state.products.length / state.state.perPage + 1,
                   },
                }).then(( {data} ) => {
                   state.commit('loadProducts',data)
                });

        },

        async loadAllProducts(state){
            await axios.get('/shop').then(({data})=>state.commit('loadAllProducts', data))
        }


    }
}