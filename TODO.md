# TODO: Allow Admin to Edit, Delete, Add Products and Allow Members to Create Tokos

## Tasks
- [x] Modify ProdukController `create` method: Admins can see all tokos, members only their own
- [x] Modify ProdukController `store` method: Admins can create products for any toko, members only for their own
- [x] Modify ProdukController `edit` method: Admins can edit any product, members only their own
- [x] Modify ProdukController `update` method: Admins can update any product, members only their own
- [x] Modify ProdukController `destroy` method: Admins can delete any product, members only their own
- [x] Modify TokoController `create` method: Allow members to access create form
- [x] Modify TokoController `store` method: Allow members to create their own tokos, admins can assign to members
- [x] Fix route 'tokos.browse' not defined: Change to 'tokos.index' in views
- [x] Add redirect to create toko if member has no toko when trying to add product
- [x] Add 'my-toko' route for members to view their own store
- [x] Update navbar to include 'Toko Saya', 'Tambah Toko', 'Tambah Produk' links for members
- [x] Allow members to create their own tokos via tokos.create
- [x] Update tokos.create view to use app layout and conditionally show id_user for admin
