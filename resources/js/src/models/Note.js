export default class Note {
    id;
    title = '';
    description = '';
    typeId = 1;
    imageUrl = null;
    createdAt = null;
    updatedAt = null;
    tasks = [];

    constructor(id, title, description, imageUrl = null, typeId = 1, createdAt = null, updatedAt = null, tasks = []) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.imageUrl = imageUrl;
        this.typeId = typeId;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.tasks = tasks;
    }
}