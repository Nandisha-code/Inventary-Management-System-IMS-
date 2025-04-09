    // ------------------ PRODUCTS ------------------

    function loadProducts() {
        const productList = document.getElementById("productsTableBody");
        const products = JSON.parse(localStorage.getItem("products")) || [];
    
        if (productList) {
            productList.innerHTML = "";
            products.forEach((product, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="border px-4 py-2"><img src="${product.image}" alt="${product.name}" class="product-image"></td>
                    <td class="border px-4 py-2">${product.name}</td>
                    <td class="border px-4 py-2">${product.price}</td>
                    <td class="border px-4 py-2">${product.quantity}</td>
                    <td class="border px-4 py-2">${product.supplier}</td>
                    <td class="border px-4 py-2">
                        <button onclick="editProduct(${index})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button onclick="deleteProduct(${index})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                `;
                productList.appendChild(row);
            });
    
            // Update count & pagination
            document.getElementById("totalItems").textContent = products.length;
            document.getElementById("startItem").textContent = products.length > 0 ? 1 : 0;
            document.getElementById("endItem").textContent = products.length;
        }
    }
    
    function addProduct(event) {
        event.preventDefault();
        const name = document.getElementById("name").value;
        const price = document.getElementById("price").value;
        const quantity = document.getElementById("quantity").value;
        const supplier = document.getElementById("supplier").value;
        const image = document.getElementById("image").value;
    
        const products = JSON.parse(localStorage.getItem("products")) || [];
        products.push({ name, price, quantity, supplier, image });
        localStorage.setItem("products", JSON.stringify(products));
    
        saveActivity("Product", name, "Added");
    
        loadProducts();
        updateDashboardStats();
        event.target.reset();
        document.getElementById("productFormContainer").classList.add("hidden");
    }
    
    function editProduct(index) {
        const products = JSON.parse(localStorage.getItem("products")) || [];
        const product = products[index];
    
        document.getElementById("name").value = product.name;
        document.getElementById("price").value = product.price;
        document.getElementById("quantity").value = product.quantity;
        document.getElementById("supplier").value = product.supplier;
        document.getElementById("image").value = product.image;
    
        document.getElementById("formTitle").textContent = "Edit Product";
        document.getElementById("productFormContainer").classList.remove("hidden");
    
        // Temporarily remove to avoid duplicate when re-saving
        deleteProduct(index);
    }
    
    function deleteProduct(index) {
        const products = JSON.parse(localStorage.getItem("products")) || [];
        const removed = products.splice(index, 1);
        localStorage.setItem("products", JSON.stringify(products));
    
        if (removed.length > 0) {
            saveActivity("Product", removed[0].name, "Deleted");
        }
    
        loadProducts();
        updateDashboardStats();
    }
    
    // Load products on page load
    window.onload = function () {
        loadProducts();
    };
    

    // ------------------ SUPPLIERS ------------------

    function loadSuppliers() {
        const supplierList = document.getElementById("supplierList");
        const suppliers = JSON.parse(localStorage.getItem("suppliers")) || [];

        if (supplierList) {
            supplierList.innerHTML = "";
            suppliers.forEach((supplier, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="border px-4 py-2">${supplier.name}</td>
                    <td class="border px-4 py-2">${supplier.contact}</td>
                    <td class="border px-4 py-2">${supplier.email}</td>
                    <td class="border px-4 py-2">
                        <button onclick="editSupplier(${index})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button onclick="deleteSupplier(${index})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                `;
                supplierList.appendChild(row);
            });
        }
    }

    function addSupplier(event) {
        event.preventDefault();
        const name = document.getElementById("supplierName").value;
        const contact = document.getElementById("supplierContact").value;
        const email = document.getElementById("supplierEmail").value;

        const suppliers = JSON.parse(localStorage.getItem("suppliers")) || [];
        suppliers.push({ name, contact, email });
        localStorage.setItem("suppliers", JSON.stringify(suppliers));

        saveActivity("Supplier", name, "Added");

        loadSuppliers();
        updateDashboardStats();
        event.target.reset();
    }

    function editSupplier(index) {
        const suppliers = JSON.parse(localStorage.getItem("suppliers")) || [];
        const supplier = suppliers[index];

        document.getElementById("supplierName").value = supplier.name;
        document.getElementById("supplierContact").value = supplier.contact;
        document.getElementById("supplierEmail").value = supplier.email;

        deleteSupplier(index);
    }

    function deleteSupplier(index) {
        const suppliers = JSON.parse(localStorage.getItem("suppliers")) || [];
        const removed = suppliers.splice(index, 1);
        localStorage.setItem("suppliers", JSON.stringify(suppliers));

        if (removed.length > 0) {
            saveActivity("Supplier", removed[0].name, "Deleted");
        }

        loadSuppliers();
        updateDashboardStats();
    }

    // ------------------ ORDERS ------------------

    function loadOrders() {
        const orderList = document.getElementById("orderList");
        const orders = JSON.parse(localStorage.getItem("orders")) || [];

        if (orderList) {
            orderList.innerHTML = "";
            orders.forEach((order, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="border px-4 py-2">${order.customer}</td>
                    <td class="border px-4 py-2">${order.product}</td>
                    <td class="border px-4 py-2">${order.quantity}</td>
                    <td class="border px-4 py-2">${order.status}</td>
                    <td class="border px-4 py-2">
                        <button onclick="editOrder(${index})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button onclick="deleteOrder(${index})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                `;
                orderList.appendChild(row);
            });
        }
    }

    function addOrder(event) {
        event.preventDefault();
        const customer = document.getElementById("orderCustomer").value;
        const product = document.getElementById("orderProduct").value;
        const quantity = document.getElementById("orderQuantity").value;
        const status = document.getElementById("orderStatus").value;

        const orders = JSON.parse(localStorage.getItem("orders")) || [];
        orders.push({ customer, product, quantity, status });
        localStorage.setItem("orders", JSON.stringify(orders));

        saveActivity("Order", product, "Placed");

        loadOrders();
        updateDashboardStats();
        event.target.reset();
    }

    function editOrder(index) {
        const orders = JSON.parse(localStorage.getItem("orders")) || [];
        const order = orders[index];

        document.getElementById("orderCustomer").value = order.customer;
        document.getElementById("orderProduct").value = order.product;
        document.getElementById("orderQuantity").value = order.quantity;
        document.getElementById("orderStatus").value = order.status;

        deleteOrder(index);
    }

    function deleteOrder(index) {
        const orders = JSON.parse(localStorage.getItem("orders")) || [];
        const removed = orders.splice(index, 1);
        localStorage.setItem("orders", JSON.stringify(orders));

        if (removed.length > 0) {
            saveActivity("Order", removed[0].product, "Deleted");
        }

        loadOrders();
        updateDashboardStats();
    }
    // Categories
    function addCategory(e) {
        e.preventDefault();
        const name = document.getElementById("categoryName").value;

        const categories = JSON.parse(localStorage.getItem("categories")) || [];
        categories.push({ name });
        localStorage.setItem("categories", JSON.stringify(categories));
        saveActivity("Category", name, "Added");
        loadCategories();
        e.target.reset();
    }

    function loadCategories() {
        const tbody = document.getElementById("categoryTableBody");
        const categories = JSON.parse(localStorage.getItem("categories")) || [];
        tbody.innerHTML = categories.map((c, i) => `
            <tr>
                <td>${c.name}</td>
                <td>
                    <button onclick="editCategory(${i})">✏️</button>
                    <button onclick="deleteCategory(${i})">🗑️</button>
                </td>
            </tr>
        `).join("");
    }


    window.editCategory = function(i) {
        const categories = JSON.parse(localStorage.getItem("categories"));
        const c = categories[i];
        document.getElementById("categoryName").value = c.name;
        categories.splice(i, 1);
        localStorage.setItem("categories", JSON.stringify(categories));
        loadCategories();
    };

    window.deleteCategory = function(i) {
        const categories = JSON.parse(localStorage.getItem("categories"));
        const name = categories[i].name;
        categories.splice(i, 1);
        localStorage.setItem("categories", JSON.stringify(categories));
        saveActivity("Category", name, "Deleted");
        loadCategories();
    };


    // ------------------ DASHBOARD + RECENT ACTIVITY ------------------

    function updateDashboardStats() {
        const products = JSON.parse(localStorage.getItem("products")) || [];
        const suppliers = JSON.parse(localStorage.getItem("suppliers")) || [];
        const orders = JSON.parse(localStorage.getItem("orders")) || [];

        document.getElementById("totalProducts").textContent = products.length;
        document.getElementById("orderCount").textContent = orders.length;
        document.getElementById("activeSuppliers").textContent = suppliers.length;

        const lowStock = products.filter(p => parseInt(p.quantity) <= 5).length;
        document.getElementById("lowStockItems").textContent = lowStock;
    }

    function saveActivity(type, item, status) {
        const activities = JSON.parse(localStorage.getItem("activities")) || [];
        const now = new Date().toLocaleString();
        activities.unshift({ type, item, date: now, status });
        if (activities.length > 10) activities.pop(); // keep only last 10
        localStorage.setItem("activities", JSON.stringify(activities));
    }

    function loadRecentActivity() {
        const recentActivity = document.getElementById("recentActivity");
        const activities = JSON.parse(localStorage.getItem("activities")) || [];

        if (recentActivity) {
            recentActivity.innerHTML = "";
            activities.forEach(activity => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">${activity.type}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${activity.item}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${activity.date}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${activity.status}</td>
                `;
                recentActivity.appendChild(row);
            });
        }
    }


    // ------------------ INIT ------------------

    document.addEventListener("DOMContentLoaded", function () {
        if (document.getElementById("productList")) loadProducts();
        if (document.getElementById("supplierList")) loadSuppliers();
        if (document.getElementById("orderList")) loadOrders();
        if (document.getElementById("orderCount")) updateDashboardStats();
        if (document.getElementById("recentActivity")) loadRecentActivity();
        if (document.getElementById("categoryTableBody")) loadCategories();
    
        const productForm = document.getElementById("productForm");
        if (productForm) productForm.addEventListener("submit", addProduct);
    
        const supplierForm = document.getElementById("supplierForm");
        if (supplierForm) supplierForm.addEventListener("submit", addSupplier);
    
        const orderForm = document.getElementById("orderForm");
        if (orderForm) orderForm.addEventListener("submit", addOrder);
    
        const categoryForm = document.getElementById("categoryForm");
        if (categoryForm) categoryForm.addEventListener("submit", addCategory);
    });
    
