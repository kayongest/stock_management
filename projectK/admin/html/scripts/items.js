
$(document).ready(function() {
    
    fetchCategories();
    fetchBrands();
    fetchItems();


    // Function to preview the image
    function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image_preview');
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block'; // Show the preview
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '#'; // Reset preview if no file selected
        preview.style.display = 'none'; // Hide preview
    }
    }

    // Function to handle form submission
    document.getElementById('saveItem').addEventListener('click', function() {
    const form = document.getElementById('itemForm');
    if (form.checkValidity()) {
        const formData = new FormData(form);
        // Add any additional data or manipulations here
        fetch('add_item.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
            // Show SweetAlert2 success pop-up with progress bar
            Swal.fire({
                icon: "success",
                html: `Item added successfully!`,
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                didOpen: () => {
                Swal.showLoading(); // Show progress bar during the countdown

                // Progress bar animation
                const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                let width = 0;
                const interval = setInterval(() => {
                    width += 1; // Increase width by 1% every 30ms
                    progressBar.style.width = width + '%';
                    if (width >= 100) {
                    clearInterval(interval); // Stop when progress is complete
                    }
                }, 30);
                },
                willClose: () => {
                // Clear the modal form
                form.reset();
                $('#itemModal').modal('hide');

                // Refresh the item list after the timer
                fetchItems();
                }
            });
            } else {
            Swal.fire('Error!', data.message || 'Failed to add item.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
        });
    } else {
        form.reportValidity(); // Show validation messages
    }
    });


    $(document).on('click', '.edit-item-btn', function() {
    const itemId = $(this).data('item-id'); // Get item ID from data attribute
    showEditModal(itemId); // Call the function to show modal with item ID
    });

    // Fetch item details and show modal
    function showEditModal(itemId) {
    $.ajax({
        url: 'get_item.php', // Your PHP script to fetch item details
        type: 'GET',
        data: {
        id: itemId
        },
        dataType: 'json',
        success: function(item) {
        // Check if the item is returned correctly
        if (item) {
            // Populate modal fields with item data
            $('#edit_item_id').val(item.id);
            $('#edit_item_name').val(item.item_name);
            $('#edit_item_description').val(item.item_description);
            $('#edit_item_serial_number').val(item.serial_number);
            $('#edit_item_status').val(item.item_status);
            $('#edit_item_category').val(item.item_category);
            $('#edit_stock_location').val(item.stock_location); // Ensure this is correctly set

            // Set the image preview to the current item's image
            $('#edit_image_preview').attr('src', `uploads/${item.item_image || "3.jpg"}`).show();

            // Clear the file input for new image upload
            $('#edit_item_image').val('');

            // Open the modal after populating the data
            $('#editItemModal').modal('show');
        } else {
            console.error('Item not found or invalid response.');
        }
        },
        error: function(xhr, status, error) {
        console.error('Error fetching item:', error);
        }
    });
    }

    // Function to preview the image
    function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image_preview');
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block'; // Show the preview
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '#'; // Reset preview if no file selected
        preview.style.display = 'none'; // Hide preview
    }
    }

    // Example of attaching the event listener using jQuery
    $(document).ready(function() {
    $("#edit_item_image").on("change", function() {
        const file = this.files[0];
        const preview = $("#edit_image_preview");

        if (file) {
        preview.attr("src", URL.createObjectURL(file)).show();
        } else {
        preview.hide();
        }
    });

    // Optionally attach a change event for adding items
    $("#item_image").on("change", previewImage);
    });

    // For the 'Edit Item' form preview
    $("#edit_item_image").on("change", function() {
    const file = this.files[0];
    const preview = $("#edit_image_preview");

    if (file) {
        preview.attr("src", URL.createObjectURL(file)).show();
    } else {
        preview.hide();
    }
    });

    // Ensure this function is bound to the correct input fields
    document.getElementById('item_image').addEventListener('change', previewImage);

    // When populating edit modal data:
    function showEditModal(itemId) {
    $.ajax({
        url: 'get_item.php',
        type: 'GET',
        data: {
        id: itemId
        },
        dataType: 'json',
        success: function(item) {
        if (item) {
            $('#edit_item_id').val(item.id);
            $('#edit_item_name').val(item.item_name);
            $('#edit_item_description').val(item.item_description);
            $('#edit_item_serial_number').val(item.serial_number);
            $('#edit_item_status').val(item.item_status);
            $('#edit_item_category').val(item.item_category);
            $('#edit_stock_location').val(item.stock_location);

            // Set image preview
            $('#edit_image_preview')
            .attr('src', `uploads/${item.item_image || "3.jpg"}`)
            .show();
            $('#edit_item_image').val('');
            $('#editItemModal').modal('show');
        }
        },
        error: function(xhr, status, error) {
        console.error('Error fetching item:', error);
        }
    });
    }


    // Attach the previewImage function to the file input for the add item section
    document.getElementById('item_image').addEventListener('change', previewImage);

    // Function to preview the image when editing an item
    $("#edit_item_image").on("change", function() {
    const [file] = this.files; // Get the first file
    const preview = $("#edit_image_preview");

    if (file) {
        // Use URL.createObjectURL for temporary preview
        preview.attr("src", URL.createObjectURL(file)).show();
    } else {
        preview.hide(); // Hide preview if no file is selected
    }
    });

    // Handle item update
    $('#updateItem').on('click', function(e) {
    e.preventDefault();

    const formData = new FormData($('#editItemForm')[0]);

    // Log form data for debugging
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    // AJAX request to update item
    $.ajax({
        url: 'update_item.php', // PHP script to handle the update
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
        if (response.status === 'success') {
            Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            });
            $('#editItemModal').modal('hide');
            fetchItems(); // Refresh the item list
        } else {
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message,
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            });
        }
        },
        error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred.',
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
        });
        },
    });
    });
});

// START CATEGORIES
    function addACategory() {
    const form = document.getElementById('categoryForm');
    if (form.checkValidity()) {
        const formData = new FormData(form);

        // Convert FormData to a plain object
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        // Add the action field
        formDataObject.action = "addCategory";

        // Send as JSON
        fetch('./backend/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Indicate that you're sending JSON
            },
            body: JSON.stringify(formDataObject), // Convert to JSON string
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Show SweetAlert2 success pop-up with progress bar
                Swal.fire({
                    icon: "success",
                    html: `Category added successfully!`,
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading(); // Show progress bar during the countdown

                        // Progress bar animation
                        const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                        let width = 0;
                        const interval = setInterval(() => {
                            width += 1; // Increase width by 1% every 30ms
                            progressBar.style.width = width + '%';
                            if (width >= 100) {
                                clearInterval(interval); // Stop when progress is complete
                            }
                        }, 30);
                    },
                    willClose: () => {
                        // Clear the modal form
                        form.reset();
                        $('#itemModal').modal('hide');

                        // Refresh the Categories list after the timer
                        fetchCategories()
                    }
                });

                const tableBody = $("#categoryTableBody");
                const categories = data.data;

            } else {
                Swal.fire('Error!', data.message || 'Failed to add category.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
        });
        } else {
            form.reportValidity(); // Show validation messages
        }
    }

    function fetchCategories() {
    console.log('Fetching categories');
    $.ajax({
        url: './backend/api.php', // Adjust the path to your API file
        type: 'POST', // Sending POST request
        dataType: 'json', // Expecting a JSON response
        contentType: 'application/json', // Inform the server about the data type
        data: JSON.stringify({ action: 'getCategories' }), // The action to invoke getCategories
        success: function(response) {

            console.log({"thiscategories":response})
        if (response.length > 0) {

            const tableBody = $("#categoryTableBody");
            tableBody.empty(); // Clear existing table rows

            updateCategoryList(response);
            // Loop through categories and create table rows
            response.forEach(category => {
            const row = `
                <tr>
                    <td>${category.name}</td>
                    <td>${category.Description || "N/A"}</td>
                    <td>${category.tag || "N/A"}</td>
                    <td>${category.category_model || "N/A"}</td>
                </tr>
            `;
            tableBody.append(row);
            });


            // Initialize or refresh DataTable
            if (!$.fn.DataTable.isDataTable("#categoryTable")) {
            $("#categoryTable").DataTable({
                responsive: true,
                paging: true,
                searching: true,
                info: true,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                pageLength: 5
            });
            } else {
            $("#categoryTable").DataTable().clear().destroy();
            $("#categoryTable").DataTable();
            }
            } 
            else {
            Swal.fire({
                icon: "info",
                title: "No Categories",
                text: "No categories were found.",
            });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching categories:", error);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "An error occurred while fetching categories.",
            });
        }
    });
    }

    function updateCategoryList(categoriesData) {
        const categoriesSelect = document.getElementById("categories");
        categoriesSelect.innerHTML = '<option value="">Choose a category</option>'; // Reset options

        categoriesData.forEach(category => {
            const option = document.createElement("option");
            option.value = category.category_id;
            option.textContent = category.name+' | '+category.Description;
            categoriesSelect.appendChild(option);
        });
    }
// END CATEGORIES

// START BRANDS
    function addABrand() {
    const form = document.getElementById('brandForm');
    if (form.checkValidity()) {
        const formData = new FormData(form);

        // Convert FormData to a plain object
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        // Add the action field
        formDataObject.action = "addBrand";

        // Send as JSON
        fetch('./backend/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Indicate that you're sending JSON
            },
            body: JSON.stringify(formDataObject), // Convert to JSON string
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Show SweetAlert2 success pop-up with progress bar
                Swal.fire({
                    icon: "success",
                    html: `Brand added successfully!`,
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading(); // Show progress bar during the countdown

                        // Progress bar animation
                        const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                        let width = 0;
                        const interval = setInterval(() => {
                            width += 1; // Increase width by 1% every 30ms
                            progressBar.style.width = width + '%';
                            if (width >= 100) {
                                clearInterval(interval); // Stop when progress is complete
                            }
                        }, 30);
                    },
                    willClose: () => {
                        // Clear the modal form
                        form.reset();
                        $('#itemModal').modal('hide');

                        // Refresh the item list after the timer
                        fetchBrands();
                    }
                });

                const tableBody = $("#brandTableBody");
                const brands = data.data;

                brands.forEach(brand => {
                    const row = `
                        <tr>
                            <td>${brand.name}</td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            } else {
                Swal.fire('Error!', data.message || 'Failed to add brand.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'An error occurred. Please try again.'+error, 'error');
        });
        } else {
            form.reportValidity(); // Show validation messages
        }
    }

    function fetchBrands() {
    console.log('Fetching brands...');
    $.ajax({
        url: './backend/api.php', // Adjust the path to your API file
        type: 'POST', // Sending POST request
        dataType: 'json', // Expecting a JSON response
        contentType: 'application/json', // Inform the server about the data type
        data: JSON.stringify({ action: 'getBrands' }), // The action to invoke getCategories
        success: function(response) {
        if (response.length > 0) {
            const tableBody = $("#brandTableBody");
            tableBody.empty(); // Clear existing table rows

            updateBrandList(response);
            // Loop through categories and create table rows
            response.forEach(brand => {
            const row = `
                <tr>
                    <td>${brand.name}</td>
                </tr>
            `;
            tableBody.append(row);
            });

            // Initialize or refresh DataTable
            if (!$.fn.DataTable.isDataTable("#brandTable")) {
            $("#brandTable").DataTable({
                responsive: true,
                paging: true,
                searching: true,
                info: true,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                pageLength: 5
            });
            } else {
            $("#brandTable").DataTable().clear().destroy();
            $("#brandTable").DataTable();
            }
            } 
            else {
            Swal.fire({
                icon: "info",
                title: "No Brands",
                text: "No brands were found.",
            });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching brands:", error);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "An error occurred while fetching brands.",
            });
        }
    });
    }

    function updateBrandList(brandsData) {
    const brandsSelect = document.getElementById("brands");
    brandsSelect.innerHTML = '<option value="">Choose a Brans</option>'; // Reset options

    brandsData.forEach(brand => {
        const option = document.createElement("option");
        option.value = brand.brand_id;
        option.textContent = brand.name;
        brandsSelect.appendChild(option);
    });
    }
// END BRANDS

// START ITEMS
    function addAnItem() {
    const form = document.getElementById('itemForm');
    console.log(form.checkValidity())
    if (form.checkValidity()) {
        const formData = new FormData(form);

        // Convert FormData to a plain object
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        // Add the action field
        formDataObject.action = "addItem";

        console.log({"addAnItem":formDataObject});
        // Send as JSON
        fetch('./backend/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Indicate that you're sending JSON
            },
            body: JSON.stringify(formDataObject), // Convert to JSON string
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Show SweetAlert2 success pop-up with progress bar
                Swal.fire({
                    icon: "success",
                    html: `Category added successfully!`,
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading(); // Show progress bar during the countdown

                        // Progress bar animation
                        const progressBar = Swal.getHtmlContainer().querySelector('.swal2-timer-progress-bar');
                        let width = 0;
                        const interval = setInterval(() => {
                            width += 1; // Increase width by 1% every 30ms
                            progressBar.style.width = width + '%';
                            if (width >= 100) {
                                clearInterval(interval); // Stop when progress is complete
                            }
                        }, 30);
                    },
                    willClose: () => {
                        // Clear the modal form
                        form.reset();
                        $('#itemModal').modal('hide');

                        // Refresh the item list after the timer
                        fetchItems();
                    }
                });

                const tableBody = $("#categoryTableBody");
                const categories = data.data;

                categories.forEach(category => {
                    const row = `
                        <tr>
                            <td>${category.name}</td>
                            <td>${category.Description || "N/A"}</td>
                            <td>${category.tag || "N/A"}</td>
                            <td>${category.category_model || "N/A"}</td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            } else {
                Swal.fire('Error!', data.message || 'Failed to add category.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
        });
        } else {
            form.reportValidity(); // Show validation messages
        }
    }

    function fetchItems() {
    
    $.ajax({
        url: './backend/api.php', // Adjust the path to your API file
        type: 'POST', // Sending POST request
        dataType: 'json', // Expecting a JSON response
        contentType: 'application/json', // Inform the server about the data type
        data: JSON.stringify({ action: 'getItems' }), // The action to invoke getCategories
        success: function(response) {
        try {
            if (response.status === "success") {
            let items = response.items;

            sortStocks(items)
            // Define category and status colors
            const categoryBadgeColors = {
                VIDEO: "#10538e",
                IT: "#5C5470",
                SOUND: "#03C988",
                SIS: "#17a2b8",
                LIGHTS: "#D36B00",
                OTHER: "#6c757d",
            };

            const statusBadgeColors = {
                New: "#262A56",
                Working: "#42855B",
                Faulty: "#461111",
                "Needs Repair": "#C69749",
                Repaired: "#577BC1",
                Leased: "#6c757d",
            };

            // Define item type button classes based on item type
            const itemTypeButtonClasses = {
                New: "btn-sm btn-success", // Green button for New
                Existing: "btn-sm btn-info" // Gray button for Existing
            };
            // Prepare the data for DataTables
            let tableData = items.map(function(item) {
                const buttonClass = itemTypeButtonClasses[item.item_type] || "btn-outline-secondary"; // Fallback to a default class
                return {
                category_name: item.category_name,
                brand_name: item.brand_name,
                item_description: item.item_description,
                serial_number: item.serial_number,
                item_status: `<span class="badge badge-pill badge-secondary" style="background-color: ${statusBadgeColors[item.item_status] || "#6c757d"};">${item.item_status}</span>`,
                stock_location: item.stock_location,
                actions: `<button class="btn btn-primary btn-xs btn-icon" data-item-id="${item.id}" data-bs-toggle="modal" data-bs-target="#editItemModal">
                            <i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs btn-icon lease-item-btn" data-item-id="${item.id}" data-item-name="${item.item_name}" data-item-category="${item.category_tag}" data-bs-toggle="modal" data-bs-target="#leaseItemModal"><i class="fa fa-trash"></i></button>`,
                };
            });

            // Update the DataTable
            if ($.fn.DataTable.isDataTable("#itemTable")) {
                const table = $("#itemTable").DataTable();
                table.clear().rows.add(tableData).draw();
            } else {
                $("#itemList").html(
                    `<table id="itemTable" class="display table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Description</th>
                            <th>Serial Number</th>
                            <th>Status</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>`
                );

                $("#itemTable").DataTable({
                data: tableData,
                columns: [
                    {
                    data: "category_name"
                    },
                    {
                    data: "brand_name"
                    },
                    {
                    data: "item_description"
                    },
                    {
                    data: "serial_number"
                    },
                    {
                    data: "item_status"
                    },
                    {
                    data: "stock_location"
                    },
                    {
                    data: "actions"
                    },
                ],
                responsive: true,
                paging: true,
                searching: true,
                info: true,
                dom: '<"top"lf>rt<"bottom"ip><"clear">',
                buttons: ["copy", "excel", "pdf", "print"],
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                pageLength: 5,
                });
            }

            // Update the equipment count
            const table = $("#itemTable").DataTable();

            function updateEquipmentCount() {
                const equipmentCount = table.rows({
                filter: 'applied'
                }).count();
                $(".equipments").text(equipmentCount);
            }

            // Update count on table draw event (when page or filter changes)
            table.on("draw", updateEquipmentCount);

            // Update count on table draw event (when page or filter changes)
            table.on("draw", updateEquipmentCount);

            // Initial count update
            updateEquipmentCount();
            } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to load items. Please try again later.",
                timer: 500,
                showConfirmButton: false,
            });
            }
        } catch (e) {
            console.error("Error processing the response:", e);
            $("#itemList").html("<p>An error occurred while loading the items.</p>");
        }
        },
        error: function(xhr, status, error) {
        console.error("Error fetching items:", error);
        $("#itemList").html("<p>Error fetching items. Please try again later.</p>");
        },
    });
    }
// END ITEMS

// STOCKS START
    function sortStocks(data){
    
    // Count items grouped by `stock_location`
    const stockCount = {};
    data.forEach((item) => {
        const location = item.stock_location;
        stockCount[location] = (stockCount[location] || 0) + 1;
    });

    // Generate cards dynamically
    const $container = $("#cards-container");
    $container.html('');
    Object.entries(stockCount).forEach(([location, count]) => {
        const cardHtml = `
            <div class="col-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${location}</h5>
                        <p class="card-text">Number of Items: <strong>${count}</strong></p>
                    </div>
                </div>
            </div>
        `;
        $container.append(cardHtml);
    });
    }
// STOCKS END