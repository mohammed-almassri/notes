export default class Task {
    id;
    title = '';
    description = '';
    createdAt = null;
    updatedAt = null;
    children = [];

    constructor(id, title, description, createdAt = null, updatedAt = null, children = []) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.children = children;
    }
}