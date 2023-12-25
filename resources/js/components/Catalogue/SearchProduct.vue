<template>
    <div class="div mt-2">
        <label for="" class="mt-2">Название товара</label>
        <input type="text" v-model="title" name="title" class="form-control mt-1 shadow hover:no-shadow" placeholder="Телевизор LED">
        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-2" style="" @click="search">Поиск по товарам</button>
        </div>
    </div>
    <div class="mt-6">
        <div v-for="(item, index) in items" class="price-item">
            <div class="content">
                <div class="img-block" style="">
                    <img :src="item.img" style="" alt="">
                </div>
                <div class="desc">
                    <p>{{ item.title }}</p>
                    <div class="prices">
                        <p v-for="price in item.prices">{{ price[0] }}: <span class="price">{{ price[1] }}</span></p>
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
            title: '',
            items: [],
        }
    },
    methods: {
        search() {
            axios.post('/product', {
                title: this.title
            }).then(response => {
                console.log(response);
                this.items = response.data;
            });
        }
    },
}
</script>
