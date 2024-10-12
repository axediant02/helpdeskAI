<template>
    <div class="admin-cms">
        <h1>Admin CMS</h1>
        <div class="admin-panel">
            <div class="section">
                <h2>Content Management</h2>
                <button @click="createContent">Create New Content</button>
                <button @click="editContent">Edit Existing Content</button>
            </div>
            <div class="section">
                <h2>User Management</h2>
                <button @click="manageUsers">Manage Users</button>
            </div>
            <div class="section">
                <h2>Settings</h2>
                <button @click="updateSettings">Update Site Settings</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AdminCMS',
    methods: {
        createContent() {
            // Logic for creating new content
            console.log('Creating new content');
        },
        editContent() {
            // Logic for editing existing content
            console.log('Editing existing content');
        },
        manageUsers() {
            // Logic for managing users
            console.log('Managing users');
        },
        updateSettings() {
            // Logic for updating site settings
            console.log('Updating site settings');
        }
    }
}
</script>

<style scoped>
.admin-cms {
    padding: 20px;
}

.admin-panel {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.section {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 8px;
    flex: 1 1 300px;
}

h1, h2 {
    margin-bottom: 20px;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #3a7bc8;
}
</style>