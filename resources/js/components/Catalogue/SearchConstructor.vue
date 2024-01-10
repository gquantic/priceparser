<template>
    <div class="div mt-2">
        <div class="row">
            <label for="" class="mt-2">Ссылка на страницу</label>
            <input type="text" v-model="href" name="href" class="form-control mt-1 shadow hover:no-shadow" placeholder="https://example.com">
        </div>
        <div class="row div mt-2">
            <div class="col-4">
                <label for="" class="mt-2">карточка товара</label>
                <input type="text" v-model="product" name="product" class="form-control mt-1 shadow hover:no-shadow" placeholder="product">
            </div>
            <div class="col-4">
                <label for="" class="mt-2">изображение</label>
                <input type="text" v-model="img" name="img" class="form-control mt-1 shadow hover:no-shadow" placeholder="img">
            </div>
            <div class="col-4">
                <label for="" class="mt-2">цена</label>
                <input type="text" v-model="price" name="price" class="form-control mt-1 shadow hover:no-shadow" placeholder="price">
            </div>
        </div>
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary mt-2" style="" @click="search">Поиск по товарам</button>
        </div>
    </div>
    <div class="mt-6">
        <div v-for="(item, index) in items" class="price-item">
            <div class="content">
                <div class="img-block" style="">
                    <img :src="item.img" style="width: 200px; height: 189px; object-fit: contain" alt="">
                </div>
                <div class="desc">
                    <p>{{ item.title }}</p>
                    <div class="prices">
                        <p v-for="price in item.prices">{{ price[0] }}: <span class="price">{{
                                formatPrice(price[1])
                            }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            href: '',
            product: '',
            img: '',
            price: '',
            items: [],
        }
    },
    methods: {
        search() {
            axios.post('/constructor', {
                href: this.href,
                product: this.product,
                img: this.img,
                price: this.price,
            }).then(response => {
                console.log(response);
                this.items = response.data;
            });
        },
        formatPrice(price) {
            return price.toLocaleString("ru-RU");
        },
    },
}
</script>
