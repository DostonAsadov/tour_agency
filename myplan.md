1. Model & Admin Panel Updates
Current Status: The project is running. The Tour model currently lacks images; images will be added by the admin when creating a new tour via the Filament admin panel.

    1.1 Add a new field for images to the Tour model.

    1.2 Customize the Filament admin panel to support the updated Tour model.

    1.3 Edit the Blade template pages where the tour's image tags need to be displayed.


2. Booking Functionality
Feature Description: On the individual tour page, there is a "Book This Tour" button. When a visitor clicks it, the key details of the tour (excluding the full description, focusing mainly on costs and essential details) must be converted into a single string. This string should be passed into a text field on the booking page form. It must be displayed to the visitor as read-only (disabled for editing), but the visitor should still be able to fill out the rest of the booking form.

    2.1 Add a redirect with query parameters to the booking page when the "Book" button on the tour page is clicked.

    2.2 Display the booking page showing the details from the previous tour page as a string inside the form text field. It is crucial that this field is restricted from editing, though the visitor should be able to add their own custom text in a separate field.

    2.3 If the visitor reloads the booking page, this passed text value must be cleared.

    2.4 Whether the visitor adds custom text or not, all required information must be sent to an Excel spreadsheet (or Google Sheets) immediately after they press the "Send" button.


3. Category Filtering
    .Feature Description: When a visitor clicks on a category button on the tour page, it should redirect them to the main tours route with a query parameter for that category's slug (e.g., ?category=slug) and display the tours filtered by that category.



4. Pagination
    .Task: Check and implement pagination on the main tours page.