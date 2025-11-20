class CoverLetter {
  const CoverLetter({required this.id, required this.content});

  final int id;
  final String content;

  factory CoverLetter.fromJson(Map<String, dynamic> json) => CoverLetter(
        id: json['id'] as int,
        content: json['content'] as String? ?? '',
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'content': content,
      };
}
