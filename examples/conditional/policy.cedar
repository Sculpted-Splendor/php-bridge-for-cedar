permit (
    principal == User::"123",
    action == Action::"read",
    resource == File::"/foo/bar"
);


permit (
    principal in Group::"Admins",
    action == Action::"delete",
    resource == File::"/foo/bar"
) when {
    resource.owner == principal
};
