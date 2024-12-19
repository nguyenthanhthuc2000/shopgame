// vite.config.js
import { defineConfig } from "file:///C:/Program%20Files/xampp/htdocs/shopgame/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/Program%20Files/xampp/htdocs/shopgame/node_modules/laravel-vite-plugin/dist/index.js";
import path from "path";
import fs from "fs";
var __vite_injected_original_dirname = "C:\\Program Files\\xampp\\htdocs\\shopgame";
function getFiles(dir, ext = "") {
  return fs.readdirSync(dir).filter((file) => file.endsWith(ext)).map((file) => `${dir}/${file}`);
}
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/sass/app.scss",
        "resources/js/app.js",
        ...getFiles("resources/js/pages-exclusive", ".js"),
        ...getFiles("resources/sass/pages-exclusive", ".scss")
      ],
      refresh: true
    })
  ],
  resolve: {
    alias: {
      "@": path.resolve(__vite_injected_original_dirname, "resources")
    }
  },
  build: {
    rollupOptions: {
      external: ["jquery"],
      output: {
        globals: {
          jquery: "jQuery"
        }
      }
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxQcm9ncmFtIEZpbGVzXFxcXHhhbXBwXFxcXGh0ZG9jc1xcXFxzaG9wZ2FtZVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcUHJvZ3JhbSBGaWxlc1xcXFx4YW1wcFxcXFxodGRvY3NcXFxcc2hvcGdhbWVcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L1Byb2dyYW0lMjBGaWxlcy94YW1wcC9odGRvY3Mvc2hvcGdhbWUvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHBhdGggZnJvbSAncGF0aCc7XG5pbXBvcnQgZnMgZnJvbSAnZnMnO1xuXG5mdW5jdGlvbiBnZXRGaWxlcyhkaXIsIGV4dCA9ICcnKSB7XG4gICAgcmV0dXJuIGZzXG4gICAgICAgIC5yZWFkZGlyU3luYyhkaXIpXG4gICAgICAgIC5maWx0ZXIoKGZpbGUpID0+IGZpbGUuZW5kc1dpdGgoZXh0KSlcbiAgICAgICAgLm1hcCgoZmlsZSkgPT4gYCR7ZGlyfS8ke2ZpbGV9YCk7XG59XG5cblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBwbHVnaW5zOiBbXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFtcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgICAgICAgICAuLi5nZXRGaWxlcygncmVzb3VyY2VzL2pzL3BhZ2VzLWV4Y2x1c2l2ZScsICcuanMnKSxcbiAgICAgICAgICAgICAgICAuLi5nZXRGaWxlcygncmVzb3VyY2VzL3Nhc3MvcGFnZXMtZXhjbHVzaXZlJywgJy5zY3NzJyksXG4gICAgICAgICAgICBdLFxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICAgICAgfSksXG4gICAgXSxcbiAgICByZXNvbHZlOiB7XG4gICAgICAgIGFsaWFzOiB7XG4gICAgICAgICAgICAnQCc6IHBhdGgucmVzb2x2ZShfX2Rpcm5hbWUsICdyZXNvdXJjZXMnKSxcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIGJ1aWxkOiB7XG4gICAgICAgIHJvbGx1cE9wdGlvbnM6IHtcbiAgICAgICAgICAgIGV4dGVybmFsOiBbJ2pxdWVyeSddLFxuICAgICAgICAgICAgb3V0cHV0OiB7XG4gICAgICAgICAgICAgICAgZ2xvYmFsczoge1xuICAgICAgICAgICAgICAgICAgICBqcXVlcnk6ICdqUXVlcnknLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9LFxuICAgICAgICB9LFxuICAgIH0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBZ1QsU0FBUyxvQkFBb0I7QUFDN1UsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sVUFBVTtBQUNqQixPQUFPLFFBQVE7QUFIZixJQUFNLG1DQUFtQztBQUt6QyxTQUFTLFNBQVMsS0FBSyxNQUFNLElBQUk7QUFDN0IsU0FBTyxHQUNGLFlBQVksR0FBRyxFQUNmLE9BQU8sQ0FBQyxTQUFTLEtBQUssU0FBUyxHQUFHLENBQUMsRUFDbkMsSUFBSSxDQUFDLFNBQVMsR0FBRyxHQUFHLElBQUksSUFBSSxFQUFFO0FBQ3ZDO0FBR0EsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTztBQUFBLFFBQ0g7QUFBQSxRQUNBO0FBQUEsUUFDQSxHQUFHLFNBQVMsZ0NBQWdDLEtBQUs7QUFBQSxRQUNqRCxHQUFHLFNBQVMsa0NBQWtDLE9BQU87QUFBQSxNQUN6RDtBQUFBLE1BQ0EsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLE9BQU87QUFBQSxNQUNILEtBQUssS0FBSyxRQUFRLGtDQUFXLFdBQVc7QUFBQSxJQUM1QztBQUFBLEVBQ0o7QUFBQSxFQUNBLE9BQU87QUFBQSxJQUNILGVBQWU7QUFBQSxNQUNYLFVBQVUsQ0FBQyxRQUFRO0FBQUEsTUFDbkIsUUFBUTtBQUFBLFFBQ0osU0FBUztBQUFBLFVBQ0wsUUFBUTtBQUFBLFFBQ1o7QUFBQSxNQUNKO0FBQUEsSUFDSjtBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
