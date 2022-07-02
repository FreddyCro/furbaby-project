const path = require('path');
const resolve = (dir) => path.join(__dirname, dir);

module.exports = {
  productionSourceMap: false,
  publicPath: `${process.env.VUE_APP_PROJECT_PATH}/`,
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
        additionalData: ` @import "@/assets/style/_variables.scss"; @import "@/assets/style/_mixins.scss";`,
      },
    },
  },
};
