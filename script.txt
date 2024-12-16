document.addEventListener("DOMContentLoaded", () => {
    // Handle seller registration
    document.getElementById("seller-registration").addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Seller Registered Successfully!");
    });

    // Handle adding crop listings
    const cropListings = document.getElementById("crop-listings");

    document.getElementById("add-crop-form").addEventListener("submit", (e) => {
        e.preventDefault();

        // Get form values
        const cropName = document.getElementById("crop-name").value;
        const cropPrice = document.getElementById("crop-price").value;
        const cropQuantity = document.getElementById("crop-quantity").value;

        // Create a new listing
        const listing = document.createElement("div");
        listing.classList.add("listing");
        listing.innerHTML = `
            <p><strong>Crop:</strong> ${cropName}</p>
            <p><strong>Price:</strong> $${cropPrice} per unit</p>
            <p><strong>Quantity:</strong> ${cropQuantity}</p>
            <button class="animated-btn edit-btn">Edit</button>
            <button class="animated-btn delete-btn">Delete</button>
        `;

        // Add edit and delete functionality
        listing.querySelector(".edit-btn").addEventListener("click", () => {
            alert("Edit functionality not implemented yet.");
        });

        listing.querySelector(".delete-btn").addEventListener("click", () => {
            listing.remove();
        });

        // Append listing to the listings section
        cropListings.appendChild(listing);

        // Clear the form
        e.target.reset();
    });

    // Buyer inquiries (placeholder for future implementation)
    const buyerMessages = document.getElementById("buyer-messages");
    buyerMessages.innerHTML = `
        <div class="inquiry">
            <p><strong>Buyer:</strong> John Doe</p>
            <p><strong>Message:</strong> Interested in 50 units of Rice.</p>
        </div>
    `;
});

