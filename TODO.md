# TODO: Make Search Case Insensitive - COMPLETED

## Controllers Updated
- [x] ItemController.php - Updated search in index method for name, description, location
- [x] CategoryController.php - Updated search in index method for name, description
- [x] SupplierController.php - Updated search in index method for name, contact_email
- [x] GuestItemController.php - Updated search in index method for name, description, location

## Changes Made
- Replaced `where('column', 'like', '%' . $request->search . '%')` with `whereRaw('LOWER(column) LIKE ?', ['%' . strtolower($request->search) . '%'])`
- This ensures both the database column and search input are lowercased for case-insensitive matching

## Summary
All search functionalities in the inventory management system are now case insensitive. Users can search for items, categories, and suppliers regardless of case differences in their search terms.
