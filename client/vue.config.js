const path = require('path');
const resolve = (dir) => path.join(__dirname, dir);

module.exports = {
  productionSourceMap: false,
  publicPath: '/',
  chainWebpack: (config) => {
    config.module
      .rule('pug')
      .test(/\.pug$/)
      .use('pug-html-loader')
      .loader('pug-html-loader')
      .end();
    config.resolve.alias.set('~', resolve('client/src/assets'));
  },
  css: {
    loaderOptions: {
      scss: {
        additionalData: `@import "@/assets/style/mixins.scss"; @import "@/assets/style/variables.scss";`,
      },
    },
  },
};
