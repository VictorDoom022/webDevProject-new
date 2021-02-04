class Users {
  final String id;
  final String username;
  final String password;
  final String email;
  final String position;
  final String create_date;

  Users({this.id, this.username, this.password, this.email, this.position, this.create_date});

  factory Users.fromJson(Map<String, dynamic> json) {
    return Users(
        id: json['id'] as String,
        username: json['username'] as String,
        password: json['title'] as String,
        email: json['email'] as String,
        position: json['position'] as String,
        create_date: json['create_date'] as String
    );
  }
}