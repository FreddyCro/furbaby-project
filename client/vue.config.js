const path = require('path');
const resolve = (dir) => path.join(__dirname, dir);

module.exports = {
  productionSourceMap: false,
  publicPath: './',
  pages: {
    index: {
      entry: 'src/main.js',
      template: 'public/index.php',
      title: '皇家營養學 毛寵達人大會考',
      description: '軟萌的幼貓、幼犬惹人憐愛，需要特殊營養為體質打底，隨著牠一天天成長，正確的轉糧與飼主照護觀念更為重要，找朋友一起挑戰你的毛寵達人級數吧！',
    },
  },
  chainWebpack: (config) => {
    config.module
      .rule('pug')
      .test(/\.pug$/)
      .use('pug-html-loader')
      .loader('pug-html-loader')
      .end();

    const svgRule = config.module.rule('svg');

    svgRule.uses.clear();
    svgRule
      .use('babel-loader')
      .loader('babel-loader')
      .end()
      .use('vue-svg-loader')
      .loader('vue-svg-loader');

    config.resolve.alias.set('~', resolve('client/src/assets'));
  },
  css: {
    loaderOptions: {
      scss: {
        additionalData: ` @import "@/assets/style/_variables.scss"; @import "@/assets/style/_mixins.scss";`,
      },
    },
  },
};
